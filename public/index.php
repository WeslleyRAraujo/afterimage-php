<?php
include_once "./bootstrap.php";

$route = new \Afterimage\Router();

$route->get('/', 'App\Controller\HomeController:index');
$route->any('/message', 'App\Controller\HomeController:json');