<?php
spl_autoload_register(function($class) {
   require str_replace('\\', '/', $class).'.php';
});

use Config\Request;
use Config\Routing;

$uri = $_SERVER['REQUEST_URI'];

if (0 < (int) strpos($uri, '?')) {
    $uri = substr($uri, 0, strpos($uri, '?'));
}
session_start();

$_SESSION['url'] = $uri;

$method = $_SERVER['REQUEST_METHOD'];

$request = new Request();
$request->setMethod($method)->setUri($uri);


$routing = new Routing($request);

$routing->getResponse();