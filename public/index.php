<?php

ini_set ( 'display_errors' , 1); error_reporting (E_ALL);

include_once "./bootstrap.php";

$route = new \Afterimage\Router;

$route->get('/', 'App\Controller\HomeController:index');
$route->get('/message', 'App\Controller\HomeController:json');
$route->get('/message/:p', 'App\Controller\HomeController:json');
