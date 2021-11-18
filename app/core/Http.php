<?php
/**
 * Classe responsável por atividades do HTTP 
 *  
 * @author Weslley Araujo (WeslleyRAraujo)
 */

namespace Afterimage\Core;

class Http
{

    /**
     * Verifica qual é o tipo de requisição
     * 
     * @return string 
     */
    public static function requestType()
    {
        return strval($_SERVER['REQUEST_METHOD']);
    } 

    /**
     * Força a página a mostrar qualquer status HTTP
     * 
     * @param int $status, status que será exibido (404, 403, 200, etc..)
     * @param array $args, argumentos que podem ser passados para o layout que será renderizado
     * 
     * @throws Exception 
     * @return void
     */
    public static function forceStatus($status, $args = []) 
    {
        if(is_int($status)) {
            http_response_code($status);
            if(!is_file(__DIR__ . "/../views/{$_ENV['ERROR_PAGE']}")) {
                throw new Exception("A view ERROR_PAGE não foi encontrada."); exit();
            }

            // as variáveis dinâmicas geradas poderão ser utilizadas no arquivo de erro
            if(count($args) > 0) {
                foreach($args as $key => $value) {
                    $$key = $value;
                }
            }
            include_once __DIR__ . "/../views/{$_ENV['ERROR_PAGE']}";
            die();
        }
        throw new Exception("O status {$status} não é valido.", 1);
    }

    /**
     * Trás os parãmetros passados via post ou get e retorna um array
     * 
     * @return array $data
     */
    public static function getResponseData()
    {
        if(Http::requestType() == "POST") {
            $data = [];
            foreach($_POST as $key => $value) {
                $data[$key] = $value;
            }
            return $data;
        }

        if(Http::requestType() == "GET") {
            $data = [];
            foreach($_GET as $key => $value) {
                $data[$key] = $value;
            }
            return $data;
        }
    }
}