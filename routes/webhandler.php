<?php
use watrlabs\router\Routing;
use watrlabs\watrkit\pagebuilder;
use watrlabs\authentication;
use watrbx\sitefunctions;

global $router;

function checkhelp() {
    echo "hi";
}

$router->get("/", function() {
    $pagebuilder = new pagebuilder();
    $pagebuilder->get_template("index");
});

$router->get("/config", function() {
    $pagebuilder = new pagebuilder();
    $pagebuilder->get_template("siteconfig/index");
});

$router->get("/items/queue", function() {
    $pagebuilder = new pagebuilder();
    $pagebuilder->get_template("items/queue");
});

$router->get('/cdn-upload', function(){
    $pagebuilder = new pagebuilder();
    $pagebuilder->get_template("cdn-upload");
});

$router->get("/reward-bc", function() {
    global $db;

    $bcitemid = 677;
    $tbcitemid = 678;
    $obcitemid = 679;

    $bcusers = $db->table("users")->where("membership", "BuildersClub")->get();
    $tbcusers = $db->table("users")->where("membership", "TurboBuildersClub")->get();
    $obcusers = $db->table("users")->where("membership", "OutrageousBuildersClub")->get();

    foreach ($bcusers as $user){
        $hashat = $db->table("ownedassets")->where("userid", $user->id)->where("assetid", $bcitemid)->first();

        if($hashat == null){
            $insert = [
                "userid"=>$user->id,
                "assetid"=>$bcitemid,
                "time"=>time()
            ];

            $db->table("ownedassets")->insert($insert);
            echo "Rewarded $user->username Builders Club Hat.<br>"; 
        }

    }

    foreach ($tbcusers as $user){
        $hashat = $db->table("ownedassets")->where("userid", $user->id)->where("assetid", $tbcitemid)->first();

        if($hashat == null){
            $insert = [
                "userid"=>$user->id,
                "assetid"=>$tbcitemid,
                "time"=>time()
            ];

            $db->table("ownedassets")->insert($insert);
            echo "Rewarded $user->username Turbo Builders Club Hat.<br>"; 
        }

    }

    foreach ($obcusers as $user){
        $hashat = $db->table("ownedassets")->where("userid", $user->id)->where("assetid", $obcitemid)->first();

        if($hashat == null){
            $insert = [
                "userid"=>$user->id,
                "assetid"=>$obcitemid,
                "time"=>time()
            ];

            $db->table("ownedassets")->insert($insert);
            echo "Rewarded $user->username Outrageous Builders Club Hat.<br>"; 
        }

    }

    die();

});

$router->get("/config/{id}/edit", function($id) {
    $pagebuilder = new pagebuilder();
    $pagebuilder->get_template("siteconfig/edit", ["id"=>$id]);
});

$router->get("/games/execute", function() {
    $pagebuilder = new pagebuilder();
    $pagebuilder->get_template("games/execute");
});


$router->get("/view/{userid}", function($userid) {
    $pagebuilder = new pagebuilder();
    $auth = new authentication();

    $userinfo = $auth->getuserbyid($userid);

    if($userinfo !== null){
        $pagebuilder->get_template("manage_user", ["userinfo"=>$userinfo]);
        die();
    }

    global $router;
    $router->return_status(404);
     
    
});

$router->get("/manage/{userid}", function($userid) {
    $pagebuilder = new pagebuilder();
    $auth = new authentication();

    $userinfo = $auth->getuserbyid($userid);

    if($userinfo !== null){
        $pagebuilder->get_template("view_info", ["userinfo"=>$userinfo]);
        die();
    }

    global $router;
    $router->return_status(404);
     
    
});

$router->get("/award/{userid}", function($userid) {
    $pagebuilder = new pagebuilder();
    $auth = new authentication();

    $userinfo = $auth->getuserbyid($userid);

    if($userinfo !== null){
        $pagebuilder->get_template("award", ["userinfo"=>$userinfo]);
        die();
    }

    global $router;
    $router->return_status(404);
     
    
});

$router->get("/inventory/{userid}", function($userid) {
    $pagebuilder = new pagebuilder();
    $auth = new authentication();

    $userinfo = $auth->getuserbyid($userid);

    if($userinfo !== null){
        $pagebuilder->get_template("inventory", ["userinfo"=>$userinfo]);
        die();
    }

    global $router;
    $router->return_status(404);
     
    
});

$router->get('/items/search', function() {
    $pagebuilder = new pagebuilder();
    $pagebuilder->get_template("items/search");
});

$router->get('/items/{id}/manage', function($itemid) {
    $pagebuilder = new pagebuilder();
        
    $itemid = (int)$itemid; // cast to int

    global $db;

    $assetinfo = $db->table("assets")->where("id", $itemid)->first();

    if($assetinfo !== null){
        $pagebuilder->get_template("items/manage", ["assetinfo"=>$assetinfo]);
        die();
    }

    global $router;
    $router->return_status(404);

});

$router->post("/items/search", function() {
    $pagebuilder = new pagebuilder();
    $auth = new authentication();

    global $db;

    if(isset($_POST["itemid"])){
        $itemid = (int)$_POST["itemid"];

        $assetinfo = $db->table("assets")->where("id", $itemid)->first();

        if($assetinfo !== null){
            $pagebuilder->get_template("items/search", ["assetinfo"=>$assetinfo]);
            die();
        }
    }


    global $router;
    $router->return_status(404);
     
    
});

$router->get("/gameserver/open-jobs", function() {
    $pagebuilder = new pagebuilder();
    $auth = new authentication();

    global $db;

    $allgamejobs = $db->table("jobs")->where("type", 1)->get();

    $pagebuilder->get_template("open_jobs", ["alljobs"=>$allgamejobs]);
    
});

$router->get("/gameserver/rcc-instances", function() {
    $pagebuilder = new pagebuilder();
    $auth = new authentication();

    global $db;

    $rccinstances = $db->table("rccinstances")->get();

    $pagebuilder->get_template("rcc_instances", ["rccinstances"=>$rccinstances]);
    
});


$router->get("/login", function() {
    $pagebuilder = new pagebuilder();
    $pagebuilder->get_template("login");
});

$router->get("/logs", function() {
    $pagebuilder = new pagebuilder();
    $pagebuilder->get_template("logs");
});

$router->get("/find-alt", function() {
    $pagebuilder = new pagebuilder();
    $pagebuilder->get_template("alt_finder");
});

$router->post("/find-alt", function() {
    $pagebuilder = new pagebuilder();
    $func = new sitefunctions();

    if(isset($_POST["username"])){
        $username = $_POST["username"];

        global $db;

        $user = $db->table("users")->where("username", $username)->first();

        if($user !== null){

            $ips = [$user->last_login_ip, $user->register_ip];

            $allalts1 = $db->table("users")->whereIn("register_ip", $ips)->get();
            $allalts2 = $db->table("users")->whereIn("last_login_ip", $ips)->get();

            $allalts = array_merge($allalts1, $allalts2);
            $pagebuilder->get_template("alt_finder", ["allalts"=>$allalts]);

            die();
        }

    }

    $pagebuilder->get_template("alt_finder");
});

$router->get("/server-info", function() {
    $pagebuilder = new pagebuilder();
    $pagebuilder->get_template("serverinfo");
});

$router->get("/{userid}/send-message", function($userid) {
    $pagebuilder = new pagebuilder();
    $pagebuilder->get_template("send-message", ["userid"=>$userid]);
});

$router->get('/moderate/{userid}', function($userid){
    $pagebuilder = new pagebuilder();
    $pagebuilder->get_template("moderate", ["userid"=>$userid]);
});

$router->post('/api/v1/login', function(){
    if(isset($_POST["username"]) && isset($_POST["password"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        global $db;

        $auth = new authentication();

        $userinfo = $db->table("users")->where("username", $username)->first();

        if($userinfo !== null){
            $hashedpass = $userinfo->password;

            $result = $auth->login($username, $password);
        
            if(isset($result["code"])){
                if($result["code"] == 200){
                    header("Location: /");
                    die();
                } else {
                    die("An error occured.");
                }
                //create_success("Succesfully Logged In!");
                
            } else {
                die("An error occured.");
            }
               

        } else {
            die("Username or password is incorrect.");
        }
    } else {
        die("An error occured.");
    }
});

$router->get("/403", function() {
    //$pagebuilder = new pagebuilder();
    //$pagebuilder->get_template("index");
    global $router;
    $router->return_status(403);
});

$router->get("/regex/testing/{yea}", function($yea) {
    echo $yea;
});

$router->group('/admin', function($router) {
    
    $router->get("/ban/{user}", function ($user) {
        echo "$user<br>";
    });
    
}, 'checkhelp');