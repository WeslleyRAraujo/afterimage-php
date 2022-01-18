<?php
include_once "./bootstrap.php";

use Afterimage\Router;

$route = new Router();

// default route declaration
$route->get('/', 'App\Controller\HomeController:index');

$route->get('/message', 'App\Controller\HomeController:json');
$route->post('/message', 'App\Controller\HomeController:json');