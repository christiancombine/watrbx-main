<?php

namespace watrbx;
use watrlabs\authentication;

class admin {

    static function pm_user($to, $subject, $content){
        global $db;
        $robloxid = $_ENV["ROBLOXACCOUNTID"];

        $insert = [
            "userfrom"=>$robloxid,
            "userto"=>$to,
            "subject"=>$subject,
            "body"=>$content,
            "date"=>time()
        ];
        
        $db->table("messages")->insert($insert);
    }

    static function get_logs($action = "all"){
        global $db;
        $allowed_actions = [
            "moderate_user",
            "send_mesage",
            "reward_currency",
            "reward_item"
        ];

        if($action = "all"){

            $auth = new authentication();
            $resultstable = [];
            $logs = $db->table("admin_logs")->limit(20)->orderBy("id", "DESC")->get();

            return $logs;

            return $resultstable;

        } else {
            if(in_array($action, $allowed_actions)){
                return $db->table("admin_logs")->where("action", $action)->limit(20)->orderBy("id", "DESC")->get();
            } else {
                throw new ErrorException("Invalid action type");
            }
        }

    }

    static function getSystemMemInfo() 
    {       
        $data = explode("\n", file_get_contents("/proc/meminfo"));
        $meminfo = [];
        foreach ($data as $line) {
            @list($key, $val) = explode(":", $line);
            @$meminfo[$key] = trim($val);
        }
        return $meminfo;
    }

    static function log_action($action, $message, $user){

        $time = time();

        global $db;

        $allowed_actions = [
            "moderate_user",
            "send_message",
            "reward_currency",
            "reward_item"
        ];

        if(in_array($action, $allowed_actions)){
            $auth = new authentication();

            $moderator = $auth->getuserbyid($user);

            if($moderator !== null){
                $insert = [
                    "action"=>$action,
                    "message"=>$message,
                    "user"=>$user,
                    "time"=>$time
                ];

                $db->table("admin_logs")->insert($insert);
                return true;
            } else {
                throw new \ErrorException("User does not exist");
            }

        } else {
            throw new \ErrorException("Invalid action type");
        }

    }

}