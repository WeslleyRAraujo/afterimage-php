<?php

namespace Afterimage\Core;
use Afterimage\Core\Http;
use Exception;

class Router
{
    // salva as rotas get
    private $getRoutes = [];

    // salva as rotas post
    private $postRoutes = [];

    // middleware validator
    private $hasPermission;

    public function __destruct()
    {
        $this->hasRoute();
    }

    // método que faz a chamada do controlador quando a requisição é do tipo GET
    public function get(string $route, string $controller)
    {

        if(Http::requestType() === 'GET') {

            if(substr($route, 0, 1) === "/" && strlen($route) > 1) {
                $route = substr($route, 1);
            }
            
            $url = str_replace(".php", "", $_REQUEST['url'] ?? '/'); 

            // inserindo mais um índice ao $this->getRoutes
            array_push($this->getRoutes, $route);
    
            if($route === $url) {
                if(!$this->checkController($controller)) {
                    die();
                }
                unset($_GET);
            }
        }
        return $this;
    }
    
    // método que faz a chamada do controlador quando a requisição é do tipo POST
    public function post(string $route, string $controller)
    {
        if(Http::requestType() == 'POST') {

            if(substr($route, 0, 1) === "/") {
                $route = substr($route, 1);
            }

            $url = str_replace(".php", "", $_REQUEST['url'] ?? '/');

            // inserindo mais um índice ao $this->getRoutes
            array_push($this->postRoutes, $route);
    
            if($route === $url) {
                if(!$this->checkController($controller)) {
                    die();
                }
                unset($_POST);
            }
        }
    }   

    // esse método verifica se o controlador e o método existem;
    private function checkController(string $controller)
    {
        $controller = explode(":", $controller);

        $class = $controller[0];
        $method = $controller[1];

        if(class_exists($class)) {
            call_user_func([$class, $method]);
            return true;
        } else {
            return false;
        }
    }

    // esse método tem a função de verificar se url acessada está contida no atributo $this->getRoutes ou em $this->postRoutes
    // caso não esteja será retornado a página de erro configurada no arquivo .env
    private function hasRoute()
    {
        $url = str_replace(".php", "", $_REQUEST['url'] ?? '/');

        if(!in_array(strval($url), $this->getRoutes) && !in_array(strval($url), $this->postRoutes)) {
            Http::forceStatus(404);
        }
    }
}