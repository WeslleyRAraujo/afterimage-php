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
    private $controllerCollection = [];
    private $paramCollection = [];
    private $lastRoute;

    public function __destruct()
    {
        $this->matchParam();
        $this->hasRoute();
    }

    public function any(string $route, string $controller)
    {
        $this->saveRoute("ANY", $route, $controller);
        $this->lastRoute = $route;
        return $this;
    }

    public function get(string $route, string $controller)
    {
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->saveRoute("GET", $route, $controller);
            $this->lastRoute = $route;
        }
        return $this;
    }
    
    public function post(string $route, string $controller)
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->saveRoute("POST", $route, $controller);
            $this->lastRoute = $route;
        }
        return $this;
    }   

    public function param($regex) {
        $this->paramCollection[$this->lastRoute] = $regex;
        unset($this->lastRoute);
    }

    private function saveRoute(string $methodHttp, string $route, string $controller, $param = null)
    {
        $this->controllerCollection[$route] = $controller;
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
        $this->executeRoute($route, $class, $method, $param);
    }

    /**
     *  execute the callback case the url is in @var this->getRoutes or @var this->postRoutes
     */
    private function executeRoute(string $route, string $class, string $method, $param = null)
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
            if(empty($param)) {
                call_user_func([$classCall, $method]);
            } else {
                call_user_func([$classCall, $method], $param);
            } 
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

            $notFound = parse_ini_file(__DIR__ . "/../settings.ini", true);
            if(isset($notFound['404_page']) && $notFound['404_page'] != '') {
                $notFound = ltrim($notFound['404_page'], '\\/');

                if(file_exists(__DIR__ . '/../views/' . $notFound)) {
                    include_once __DIR__ . '/../views/' . $notFound;
                } else {
                    echo "Página não encontrada.";
                }
            } else {
                echo "Página não encontrada.";
            }
        }
    }

    private function matchParam()
    {
        $url = explode("/", $_REQUEST['url'] ?? "/"); // current url
        $urlTemp = $url; 
        $attr = ["getRoutes", "postRoutes"];
        foreach($attr as $call) {
            foreach($this->$call as $route) {
                // case the route have :p will be checked if the current url match with a route declared in $this->getRoutes or $this->postRoutes
                if(mb_strpos($route, ":p")) {
                    $routeController = $route; // route for searching in $this->controllerCollection
                    $needle = ":p"; 
                    $route = explode("/", $route); // route 
                    $position = array_search($needle, $route);
                    $url[$position] = ":p"; // current url
                    if($url === $route) {
                        if(!isset($urlTemp[$position])){return false;} // if not isset the position in current the page 404 will be returned
                        $route[$position] = $urlTemp[$position];
                        $param = $urlTemp[$position];
                        if(empty($param)){return false;} // if param is empty don't match
                        $route = implode("/", $route);
                        $url = implode("/", $url);
                        $param = $this->checkParamEx("/" . $url, $param);
                        if(!$param){return false;} // if the parameter does not match the 'where' of the route, page 404 will be returned
                        array_push($this->$call, $route);
                        if(!$param){return false;}
                        if($_SERVER['REQUEST_METHOD'] === 'GET') {
                            $this->saveRoute("GET", $route, $this->controllerCollection["/" . $routeController], $param);
                            break;
                        } elseif($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $this->saveRoute("POST", $route, $this->controllerCollection["/" . $routeController], $param);
                            break;
                        }
                    }
                }
            }
        }
    }

    private function checkParamEx($route, $param) 
    {
        if(!isset($this->paramCollection[$route])) {
            return $param;
        }
        switch ($this->paramCollection[$route]) {
            case 'int':
                if(intval($param)) {
                    return intval($param);
                }
                return false;
                break;
            case 'string':
                if(intval($param)) {
                    return false;
                }
                if(strval($param)) {
                    return strval($param);
                }
                break;
            case 'any':
                if(intval($param)) {
                    return intval($param);
                }
                if(strval($param)) {
                    return strval($param);
                }
                break;
            default:
                throw new \RuntimeException("Solicitação inválida."); die();
        }
    }
}