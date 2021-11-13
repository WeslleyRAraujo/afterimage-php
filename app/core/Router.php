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

    public function __destruct()
    {
        $this->hasView();
    }

    // método que faz a chamada do controlador quando a requisição é do tipo GET
    public function get(string $route, string $controller)
    {
        if(Http::requestType() === 'GET') {

            $url = str_replace(".php", "", $_REQUEST['url'] ?? '/'); 

            // inserindo mais um índice ao $this->getRoutes
            array_push($this->getRoutes, $route);
    
            if($route === $url) {
                if(!$this->checkController($controller)) {
                    die();
                }
            }
        }
    }
    
    // método que faz a chamada do controlador quando a requisição é do tipo POST
    public function post(string $route, string $controller)
    {
        if(Http::requestType() == 'POST') {
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

        try {
            call_user_func([$class, $method]);
            return true;
        } catch (Exception $e) {
            throw new Exception(sprintf("não foi possível localizar o controlador %s", $controller[0]));
            return false; exit();
        }
    }

    // esse método tem a função de verificar se url acessada está contida no atributo $this->getRoutes ou em $this->postRoutes
    // caso não esteja será retornado a página de erro configurada no arquivo .env
    private function hasView()
    {
        $url = str_replace(".php", "", $_REQUEST['url'] ?? '/');

        if(!in_array(strval($url), $this->getRoutes) && !in_array(strval($url), $this->postRoutes)) {
            Http::forceStatus(404);
        }
    }
}