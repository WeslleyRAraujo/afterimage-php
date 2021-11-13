<?php

include_once "./bootstrap.php";

use Afterimage\Core\Router;

$route = new Router();

// get route
// $route->get('home', 'App\Controller\HomeController:index');
$route->get('/', 'App\Controller\HomeController:index');

// post route
//$route->post('teste', 'App\Controller\TestController:store');