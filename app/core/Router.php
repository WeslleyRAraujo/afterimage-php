<?php
/**
 * Classe responsável pelo roteamento
 * 
 * @author Weslley Araujo (WeslleyRAraujo)
 */

namespace Afterimage\Core;
use Afterimage\Core\Http;
use Exception;

class Router
{
    private $getRoutes = [];
    private $postRoutes = [];

    public function __destruct()
    {
        $this->hasRoute();
    }

    /**
     * adiciona mais um índice em @var this->getRoutes
     * 
     * @param string $route, rota a ser adicionada
     */
    public function feedGetRoute($route)
    {
        array_push($this->getRoutes, $route);
    }

    /**
     * adiciona mais um índice em @var this->postRoutes
     * 
     * @param string $route, rota a ser adicionada
     */
    public function feedPostRoute($route)
    {
        array_push($this->postRoutes, $route);
    }

    /**
     * Faz a chamada do controlador 
     * quando a rota for declarada pelo método GET
     * 
     * @param string $route, rota
     * @param string $controller, controlador + método, separados por ':'
     * 
     * @return this
     */
    public function get(string $route, string $controller)
    {
        if(Http::requestType() === 'GET') {

            // caso o primeiro caractere da rota seja '/' será removido
            if(substr($route, 0, 1) === "/" && strlen($route) > 1) {
                $route = substr($route, 1);
            }

            $controller = explode(":", $controller);
            $class = $controller[0];
            $method = $controller[1];

            $this->feedGetRoute($route);

            $this->executeRoute($route, $class, $method);
        }
        return $this;
    }
    
    /**
     * Faz a chamada do controlador 
     * quando a rota for declarada pelo método POST
     * 
     * @param string $route, rota
     * @param string $controller, controlador + método, separados por ':'
     * 
     * @return this
     */
    public function post(string $route, string $controller)
    {
        if(Http::requestType() === 'POST') {

            // caso o primeiro caractere da rota seja '/' será removido
            if(substr($route, 0, 1) === "/" && strlen($route) > 1) {
                $route = substr($route, 1);
            }

            $controller = explode(":", $controller);
            $class = $controller[0];
            $method = $controller[1];

            $this->feedPostRoute($route);

            $this->executeRoute($route, $class, $method);
        }
        return $this;
    }   

    /**
     * Verifica se o controlador existe
     * 
     * @param string $class, classe
     * 
     * @return bool
     */
    private function checkController($class)
    {
        if(class_exists($class)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checa se a URL tem a extensão .php 
     * 
     * @return bool
     */
    private function dotPhp()
    {
        if(mb_strpos($_SERVER['REQUEST_URI'], '.php')){
            return true;
        } else {
            return false;
        }
    }

    /**
     *  executa o callback caso a url esteja em @var this->getRoutes ou em @var this->postRoutes
     * 
     * @param string $route, rota 
     * @param string $class, classe do callback
     * @param string $method, método do callback
     * 
     * @return void 
     */
    private function executeRoute($route, $class, $method)
    {
        // url atual
        $url = str_replace(".php", "", $_REQUEST['url'] ?? '/');

        // só vai chamar o callback da rota estiver sendo acessada
        if($route === $url) {
            if(!$this->checkController($class)) {
                die("O Controlador {$class} não existe.");
            }
            
            // caso a url tenha a ocorrência '.php' vai retornar um staus 404
            if($this->dotPhp()) {
                Http::forceStatus(404, [
                    'title' => 'Página não encontrada',
                    'error' => 404,
                    'message' => 'Houston, we have a problem.'
                ]);
            }

            $classCall = new $class();
            call_user_func([$classCall, $method]);
        }
    }

    /**
     * Verifica se a url acessada existe em @var this->getRoutes ou @var this->postRoutes
     * caso não será retornada uma página de erro com status 404
     * 
     * @return void
     */
    private function hasRoute()
    {
        $url = str_replace(".php", "", $_REQUEST['url'] ?? '/');

        if(!in_array(strval($url), $this->getRoutes) && !in_array(strval($url), $this->postRoutes)) {
            Http::forceStatus(404, [
                'title' => 'Página não encontrada',
                'error' => 404,
                'message' => 'Houston, we have a problem.'
            ]);
        }
    }
}