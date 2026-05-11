<?php

namespace watrbx;
use watrbx\sitefunction;
use watrlabs\authentication;
use watrbx\sitefunctions;
use watrlabs\watrkit\pagebuilder;
global $db;

class gameserver {

    private $current_server = [];
    private $connecting_user;
    private $close_server;
    private $grid;
    private $server;

    function __construct(){
        $func = new sitefunctions();
        $ip = $func->getip();
        $auth = new authentication();
        $this->connecting_user = $auth->geolocateip($ip);
        $this->close_server = $this->get_closest_server();
        $this->grid = $this->get_grid($this->close_server);
    }

    private function get_grid($server){
        $this->grid = new \watrbx\Grid\Open\Service("http://{$server->wireguard_ip}:{$server->port}");
    }

    public function ping($server, $port){
        return 1;
    }

    public function get_server_info($serverid){
        global $db;
        return $db->table("servers")->where("server_id", $serverid)->first();
    }

    public function calc_distance($lat1, $lon1, $lat2, $lon2){
        $earthsRadius = 6371;
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);
        $deltaLat = $lat2 - $lat1;
        $deltaLon = $lon2 - $lon1;
        $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
            cos($lat1) * cos($lat2) *
            sin($deltaLon / 2) * sin($deltaLon / 2);
        return $earthsRadius * 2 * atan2(sqrt($a), sqrt(1 - $a));
    }

    public function get_all_servers(){
        global $db;
        return $db->table("servers")->get();
    }

    public function get_server_url($serverinfo){
        return "http://{$serverinfo->wireguard_ip}:{$serverinfo->port}";
    }

    public function get_closest_server(){
        $all_servers = $this->get_all_servers();
        if($all_servers){
            $min_dis = PHP_INT_MAX;
            $close_server = null;
            foreach ($all_servers as $server){
                $auth = new authentication();
                $auth->geolocateip($server->ip);
                $user_lat = $this->connecting_user["latitude"] ?? 0;
                $user_lon = $this->connecting_user["longitude"] ?? 0;
                $server_lat = 33.7485;
                $server_lon = -84.3871;
                $distance = $this->calc_distance($user_lat, $user_lon, $server_lat, $server_lon);
                if ($distance < $min_dis) {
                    $min_dis = $distance;
                    $close_server = $server;
                }
            }
            return $close_server;
        }
        return false;
    }

    public function validate_api_key($key){
        global $db;
        return $db->table("apikeys")->where("apikey", $key)->exists();
    }

    public function create_api_key($jobid = null, $expiration = null){
        $sitefunc = new sitefunctions();
        global $db;
        $apikey = $sitefunc->genstring(25);
        $db->table("apikeys")->insert([
            "apikey"=>$apikey,
            "jobid"=>$jobid,
            "expiration"=>$expiration
        ]);
        return $apikey; 
    }

    public function is_gameserver_ip($ip){
        global $db;
        $result = $db->table("servers")->where("ip", $ip)->orWhere("ipv6", $ip)->first();
        return $result !== null;
    }

    public function end_job($jobid){
        global $db;
        $db->table("jobs")->where("jobid", $jobid)->delete();
        $db->table("game_instances")->where("serverguid", $jobid)->delete();
        $db->table("activeplayers")->where("jobid", $jobid)->delete();
        $server = $this->close_server;
        $Grid = new \watrbx\Grid\Close\Service("http://{$server->wireguard_ip}:{$server->port}");
        return $Grid->CloseJob($jobid);
    }

    static function get_active_players($placeid){
        global $db;
        return $db->table("activeplayers")->where("placeid", $placeid)->count();
    }

    static function get_visits($userid, $limit = null){
        global $db;
        $query = $db->table("visits")
            ->select($db->raw("MAX(id) as id"))
            ->where("userid", $userid)
            ->groupBy("universeid");
        if($limit) $query->limit($limit);
        $rows = $query->get();
        if(empty($rows)) return false;
        $unique = array_column($rows, 'id');
        $query2 = $db->table("visits")
            ->whereIn("id", $unique)
            ->orderBy("id", "desc");
        if($limit) $query2->limit($limit);
        return $query2->get();
    }

    public function execute_job($jobinfo, $scriptinfo){
        $server = $this->close_server;
        $Grid = new \watrbx\Grid\Open\Service("http://{$server->wireguard_ip}:{$server->port}");
        return $Grid->OpenJobEx($jobinfo, $scriptinfo);
    }

    public function gen_port(){
        return rand(4000, 4500);
    }

    public function request_game($placeid, $context){
        $func = new sitefunctions();
        $pagebuilder = new pagebuilder();
        $jobid = $func->createjobid();
        $port = $this->gen_port();
        $close_server = $this->close_server;
        $apikey = $this->create_api_key($jobid);
        global $db;
        $db->table("jobs")->insert([
            "jobid"=>$jobid,
            "type"=>1,
            "assetid"=>$placeid,
            "port"=>$port,
            "apikey"=>$apikey,
            "server"=>$close_server->server_id,
        ]);
        $gamescript = $pagebuilder->get_from_storage("lua/game.lua");
        $jobInfo = [
            "Id"=>$jobid,
            "Expiration"=>120, 
            "Category"=>1,
            "Cores"=>2 
        ];
        $ScriptInfo = [
            "Name"=>"Game Script",
            "Script"=>$gamescript,
            "Arguments"=>[
                "placeId"=>$placeid,
                "port"=>(int)$port,
                "sleeptime"=>10,
                "access"=>$apikey,
                "baseUrl"=>"watrbx.wtf",
                "protocol"=>"http://",
                "apiKey"=>$apikey,
                "matchmakingContextId"=>$context,
                "assetGameSubdomain"=>"assetgame."
            ]
        ];
        $result = $this->execute_job($jobInfo, $ScriptInfo);
        return [
            "Result"=>$result,
            "jobId"=>$jobid
        ];
    }

}
