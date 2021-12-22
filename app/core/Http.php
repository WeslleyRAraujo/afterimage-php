<?php
/**
 * Simple HTTP Class 
 *  
 * @author Weslley Araujo (WeslleyRAraujo)
 */

namespace Afterimage\Core;

class Http
{

    /**
     * Check the request type GET|POST
     * 
     * @return string 
     */
    public static function requestType()
    {
        return strval($_SERVER['REQUEST_METHOD']);
    } 

    /**
     * Force the page to load any HTTP status 
     * 
     * @param int $status, status that be returned (404, 403, 200, etc..)
     * @param array $args, args for render layout
     * 
     * @throws Exception 
     * @return void
     */
    public static function forceStatus($status, $args = []) 
    {
        if(is_int($status)) {
            http_response_code($status);
            if(!is_file(__DIR__ . "/../views/{$_ENV['ERROR_PAGE']}")) {
                throw new \Exception("A view ERROR_PAGE não foi encontrada."); exit();
            }

            // dynamic variables for use in error file
            if(count($args) > 0) {
                foreach($args as $key => $value) {
                    $$key = $value;
                }
            }

            include_once __DIR__ . "/../views/{$_ENV['ERROR_PAGE']}";
            die();
        }
        throw new \Exception("O status {$status} não é valido.", 1);
    }

    /**
     * catch the parameters passed in post or get and return array
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