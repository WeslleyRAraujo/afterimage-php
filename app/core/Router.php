<?php
/**
 * Router Class
 * 
 * @author Weslley Araujo (WeslleyRAraujo)
 */

namespace Afterimage;
use Afterimage\Http;

class Router
{
    private $getRoutes = []; // get routes
    private $postRoutes = []; // post routes
    private $sessionAllowed = []; // routes with session
    private $switchMethod; // catch the last method acessed 

    public function __destruct()
    {
        $this->hasRoute();
    }

    /**
     * add one more index in @var this->getRoutes
     * 
     * @param string $route, route to be redirect
     */
    private function feedGetRoute(string $route)
    {
        array_push($this->getRoutes, $route);
    }

    /**
     * add one more index @var this->postRoutes
     * 
     * @param string $route, route to be redirect
     */
    private function feedPostRoute(string $route)
    {
        array_push($this->postRoutes, $route);
    }

    /**
     * add one more index in @var this->sessionAllowed
     * 
     */
    private function feedSession(string $route, string $session, string $value, string $redirect)
    {
        $this->sessionAllowed[$route] = "$session:$value:$redirect";
    }

    /**
     * make controller call
     * when route method is GET
     * 
     * @param string $route
     * @param string $controller, controller + method, separated by ':'
     * 
     * @return this
     */
    public function get(string $route, string $controller)
    {
        if(Http::requestType() === 'GET') {

            // case the first char is '/' will be removed
            if(substr($route, 0, 1) === "/" && strlen($route) > 1) {
                $route = substr($route, 1);
            }

            $controller = explode(":", $controller);
            $class = $controller[0];
            $method = $controller[1];

            $this->feedGetRoute($route);
            $this->switchMethod = 'GET';
            $this->executeRoute($route, $class, $method);
        }
        return $this;
    }
    
    /**
     * make controller call
     * when route method is POST
     * 
     * @param string $route
     * @param string $controller, controller + method, separated by ':'
     * 
     * @return this
     */
    public function post(string $route, string $controller)
    {
        if(Http::requestType() === 'POST') {

            // case the first char is '/' will be removed
            if(substr($route, 0, 1) === "/" && strlen($route) > 1) {
                $route = substr($route, 1);
            }

            $controller = explode(":", $controller);
            $class = $controller[0];
            $method = $controller[1];

            $this->feedPostRoute($route);
            $this->switchMethod = 'POST';
            $this->executeRoute($route, $class, $method);
        }
        return $this;
    }   

    /**
     * check if controller exists
     * 
     * @param string $class
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
     * check if URL have the extension .php 
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
     *  execute the callback case the url is in @var this->getRoutes or @var this->postRoutes
     * 
     * @param string $route
     * @param string $class
     * @param string $method
     * 
     * @return void 
     */
    private function executeRoute(string $route, string $class, string $method)
    {
        $url = str_replace(".php", "", $_REQUEST['url'] ?? '/');

        // only execute callback if url is being acessed
        if($route === $url) {
            if(!$this->checkController($class)) {
                die("O Controlador {$class} não existe.");
            }
            
            // if url have '.php' the status HTTP 404 is returned
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
     * verify if the url that is being acessed exists in @var this->getRoutes or @var this->postRoutes
     * case not will be returned a error page 404
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

        $this->checkSession($url);
    }
    
    /**
     * check if route has been acessed have a session for validate
     * 
     * @param string $route, route for validate
     * 
     * @return void
     */
    private function checkSession(string $route)
    {
        if(isset($this->sessionAllowed[$route])) {
            $verifyStep = explode(':', $this->sessionAllowed[$route]);
        
            $session = $verifyStep[0];
            $sessionValue = $verifyStep[1];
            $redirect = $verifyStep[2];
            
            if($_SESSION[$session] != $sessionValue) {
                header("location: $redirect");
            }
        }
    }

    /**
     * create a node between session and route
     * just allowing if the route meet the requirements
     * of session value
     * 
     * @param string $session, session key
     * @param string $value, session value
     * @param string $redirect, case don't meet the application will be redirect for this route
     * 
     * @return void
     */
    public function session(string $session, string $value, string $redirect) 
    {
        switch ($this->switchMethod) {
            case $this->switchMethod === 'GET':
                $this->feedSession(end($this->getRoutes), $session, $value, $redirect);
                break;
            
            case $this->switchMethod === 'POST':
                $this->feedSession(end($this->postRoutes), $session, $value, $redirect);
                break;
        }
    }
}