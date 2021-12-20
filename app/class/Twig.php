<?php

/**
 * Classe responsável por retornar a view utilizando o Twig
 * Atenção: todos os arquivos no diretório /app/views precisam terminar com a extensão '.twig' para funcionar com a template engine
 * 
 * @author Weslley Araujo (WeslleyRAraujo)
 */

namespace App\Classes;

class Twig
{
    /** 
     * Cria a view
     *
     * @param string $view, o nome da view
     * @param array $args, argumentos que vão ser passados para criar a view
     * vide exemplo: https://twig.symfony.com/doc/3.x/intro.html [final da página]
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
            throw new Exception("A view {$view} não existe");
        }
    }
}

