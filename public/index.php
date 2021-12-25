<?php
include_once "./bootstrap.php";

use Afterimage\Router;

$route = new Router();

// default route declaration
$route->get('/', 'App\Controller\HomeController:index');

// the routes can also be declared in this way, recommended for route group
$route
    ->get('/message', 'App\Controller\HomeController:json')
    ->post('/message', 'App\Controller\HomeController:json');