<?php

namespace App\Classes;

class Twig
{
    public function view($view, $args = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views/');
        $twig = new \Twig\Environment($loader);
        // $twig->render("{$view}.twig", $args);
        return $twig->display("{$view}.twig", $args);
    }
}

