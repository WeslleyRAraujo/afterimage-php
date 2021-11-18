<?php

include_once "./bootstrap.php";

use Afterimage\Core\Router;

$route = new Router();

// Declaração padrão de rota
$route->get('/', 'App\Controller\HomeController:index');


// As rotas também podem ser declaradas da forma abaixo, recomendado para agrupamento de rotas
$route
    ->get('/message', 'App\Controller\HomeController:json')
    ->post('/message', 'App\Controller\HomeController:json');

