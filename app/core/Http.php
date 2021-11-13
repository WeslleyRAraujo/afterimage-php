<?php

namespace Afterimage\Core;

class Http
{

    // retorna o status http atual
    public static function requestType()
    {
        return strval($_SERVER['REQUEST_METHOD']);
    } 

    // método para forçar qualquer status http
    public static function forceStatus($status, $args = []) 
    {
        if(is_int($status)) {

            http_response_code($status);

            // cria as variáveis dinamicas para usar direto na view
            if(!count($args) == 0) {
                foreach ($args as $key => $value) {
                    $$key = $value;
                }
            }

            include_once __DIR__ . "/../views/{$_ENV['ERROR_PAGE']}";
            die();
        }
        throw new Exception("O status {$status} não é valido.", 1);
    }
}