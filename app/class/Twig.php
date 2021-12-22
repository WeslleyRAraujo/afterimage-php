<?php

/**
 * Class that return a view using Twig Template Engine
 * Caution: all files in /app/views need have '.twig' extension for working with Template Engine
 * 
 * @author Weslley Araujo (WeslleyRAraujo)
 */

namespace App\Classes;

class Twig
{
    /** 
     * Create view
     *
     * @param string $view, name of view
     * @param array $args, args that be passed for view
     * example: https://twig.symfony.com/doc/3.x/intro.html [final of page]
     * 
     * @return Twig::display
     * or
     * @throws Exception
     */
    public static function view($view, $args = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views/');
        $twig = new \Twig\Environment($loader);
        $twig->addGlobal('session', $_SESSION);
        if(is_file(__DIR__ . "/../views/{$view}.twig")) {
            return $twig->display("{$view}.twig", $args);
        } else {
            throw new \Exception("A view {$view} não existe");
        }
    }
}

