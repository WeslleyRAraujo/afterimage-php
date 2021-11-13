<?php

/**
 * 
 * arquivo de funções para manipulação das views e auxiliares de layout
 * 
 */

use Afterimage\Core\View;

if(!function_exists('view')) {

    // função para retornar uma view
    function view($view, $args = [])
    {
        View::getView($view, $args);
    }
}

if(!function_exists('extend_view')) {

    // função para extender a view
    function extend_view($view)
    {
        View::extends($view);
    }
}

if(!function_exists('asset')) {

    // função para incluir o caminho dos assets
    function asset($asset)
    {
        View::includeAsset($asset);
    }
}

