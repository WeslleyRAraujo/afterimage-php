<?php

include_once "./bootstrap.php";

use Afterimage\Core\Router;

$route = new Router();

$route->get('/', 'App\Controller\HomeController:index');
$route->get('/login', 'App\Controller\LoginController:index');
$route->get('/login/exit', 'App\Controller\LoginController:exit');

$route->post('/login/auth', 'App\Controller\LoginController:auth');
