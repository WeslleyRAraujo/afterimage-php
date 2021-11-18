<?php

/**
 * Arquivo de funções comuns
 * 
 * @author Weslley Araujo (WeslleyRAraujo)
 */
use App\Classes\Twig;

if(!function_exists('view')) {

    /**
     * Retorna a View pelo Twig
     * 
     * @param string $view, nome da view sem a extensão
     * @param array $args, variáveis que serão passadas
     * 
     * @return Twig::view
     */
    function view($view, $args = [])
    {
        return Twig::view($view, $args);
    }
}

