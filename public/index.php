<?php

include_once "./bootstrap.php";

$route = new \Afterimage\Router;

$route->get('/', 'App\Controller\HomeController:index');
$route->any('/message/:p', 'App\Controller\HomeController:message')->param("any");

