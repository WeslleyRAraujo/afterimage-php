<?php

/**
 * common funcions
 * 
 * @author Weslley Araujo (WeslleyRAraujo)
 */
use App\Classes\Twig;

if(!function_exists('view')) {

    /**
     * return the view by twig
     * 
     * @param string $view, name of view without extension
     * @param array $args, vars that can be passed
     * 
     * @return Twig::view
     */
    function view($view, $args = [])
    {
        return Twig::view($view, $args);
    }
}

