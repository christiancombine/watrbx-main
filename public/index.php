<?php
use watrlabs\router\routing;
use watrlabs\authentication;

global $router;
require_once '../init.php';

$router = new routing();
$auth = new authentication();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if(!$auth->hasaccount() && $uri !== "/login" && $uri !== "/api/v1/login"){
    header("Location: /login");
}

$router->addrouter('webhandler');
$router->addrouter('apihandler');


$method = $_SERVER['REQUEST_METHOD'];
$router->dispatch($uri, $method);

// aaaaaaaaaaaaaaaa my brain hurts 