<?php
/**
 * Router Class
 * 
 * @author Weslley Araujo (WeslleyRAraujo)
 */

namespace Afterimage;

class Router
{
    private $getRoutes = [];
    private $postRoutes = [];

    public function __destruct()
    {
        $this->hasRoute();
    }

    public function any(string $route, string $controller)
    {
        $this->saveRoute("ANY", $route, $controller);
        return $this;
    }

    public function get(string $route, string $controller)
    {
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->saveRoute("GET", $route, $controller);
        }
        return $this;
    }
    
    public function post(string $route, string $controller)
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->saveRoute("POST", $route, $controller);
        }
        return $this;
    }   

    private function saveRoute(string $methodHttp, string $route, string $controller)
    {
        // case the first char is '/' will be removed
        if(substr($route, 0, 1) === "/" && strlen($route) > 1) {
            $route = substr($route, 1);
        }
        $controller = explode(":", $controller);
        $class = $controller[0];
        $method = $controller[1];
        switch (strtoupper($methodHttp)) {
            case 'GET':
                array_push($this->getRoutes, $route);
                break;
            case 'POST':
                array_push($this->postRoutes, $route);
                break;
            case 'ANY':
                array_push($this->getRoutes, $route);
                array_push($this->getRoutes, $route);
                break;
        }
        $this->executeRoute($route, $class, $method);
    }

    /**
     *  execute the callback case the url is in @var this->getRoutes or @var this->postRoutes
     */
    private function executeRoute(string $route, string $class, string $method)
    {
        $url = str_replace(".php", "", $_REQUEST['url'] ?? '/');
        // only execute callback if url is being acessed
        if($route === $url) {
            if(!class_exists($class)) {
                die("O Controlador {$class} não existe.");
            }
            // if url have '.php' the status HTTP 404 is returned
            if(mb_strpos($_SERVER['REQUEST_URI'], '.php')) {
                header("HTTP/1.0 404 Not Found");
                http_response_code(404);
                echo "Página não encontrada."; die();
            }
            $classCall = new $class();
            call_user_func([$classCall, $method]);
        }
    }

    /**
     * verify if the url that is being acessed exists in @var this->getRoutes or @var this->postRoutes
     * case not will be returned a error page 404
     */
    private function hasRoute()
    {
        $url = str_replace(".php", "", $_REQUEST['url'] ?? '/');
        if(!in_array(strval($url), $this->getRoutes) && !in_array(strval($url), $this->postRoutes)) {
            header("HTTP/1.0 404 Not Found");
            http_response_code(404);
            echo "Página não encontrada."; die();
        }
    }
}