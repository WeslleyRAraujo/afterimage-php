<?php

namespace Afterimage\Core;
use Exception;

class view
{

    // cache de parâmetros da view
    private static $argsCache = [];

    // método que faz a renderização da view
    public static function getView($view, $args = [])
    {
        // cria as variáveis dinamicas para usar direto na view
        if(!count($args) == 0) {
            self::$argsCache = $args;
            foreach ($args as $key => $value) {
                $$key = $value;
            }
        }
        
        if(file_exists(__DIR__ . "/../views/{$view}.php")) {
            include_once __DIR__ . "/../views/{$view}.php";
        } else {
            throw new Exception(sprintf("A view %s não foi encontrada em /views.", $view));   
        }
    }

    // método que faz a renderização da view
    public static function extends($view)
    {
        // cria as variáveis dinamicas para usar direto na view
        if(!count(self::$argsCache) == 0) {
            foreach (self::$argsCache as $key => $value) {
                $$key = $value;
            }
            self::$argsCache = [];
        }

        if(file_exists(__DIR__ . "/../views/{$view}.php")) {
            include_once __DIR__ . "/../views/{$view}.php";
        } else {
            throw new Exception(sprintf("A view %s não foi encontrada em /views.", $view));   
        }
    }

    // método que faz a inclusão dos assets (css, js ...)
    public static function includeAsset($asset)
    {
        $baseAssetDir = $_ENV['ASSET_DIR']; 
        
        if(is_file(__DIR__ . "/../../public/{$baseAssetDir}/{$asset}")) {
            echo "{$baseAssetDir}/{$asset}";
        } else {
            throw new InvalidArgumentException(sprintf("O asset %s não foi encontrado.", $asset));
        }
    }
}
?>