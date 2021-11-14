<?php

/**
 * 
 * arquivo de funções para manipulação das views e auxiliares de layout
 * 
 */

use Afterimage\Core\View;
use App\Classes\Twig;

if(!function_exists('view')) {

    // função para retornar uma view
    function view($view, $args = [])
    {
        Twig::view($view, $args);
    }
}

if(!function_exists('asset')) {

    // função para incluir o caminho dos assets
    function asset($asset)
    {
        View::includeAsset($asset);
    }
}

