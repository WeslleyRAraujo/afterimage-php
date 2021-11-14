<?php

/**
 * 
 * CLASSE DO CORE EM CONSTRUÇÃO
 * 
 */
namespace Afterimage\Core;

class Session
{
    public function __construct()
    {
        if(session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    // seta os valores de sessão, recebe um array como parâmetro
    public static function set($sessionArr = [])
    {   
        if(count($sessionArr) == 0) {
            throw new Exception("A sessão não pode ser criada. Parâmetros = 0"); die();
        }

        try {
            foreach($sessionArr as $key => $value) {
                $_SESSION[$key] = $value;
            }
        } catch(Exception $e) {
            throw new Exception("Erro na criação da sessão, formato do array inválido."); die();
        }
    }

    public function get($sessionValue)
    {
        foreach($sessionValue as $key => $value) {
            if(isset($_SESSION[$key]) && $_SESSION[$key] === $value) {
                return true;
            } else {
                return false;
            }
        }
    }

    // mata todas a sessões, recomendação diretamente do manual do PHP 
    // https://www.php.net/manual/pt_BR/function.session-destroy.php
    public static function kill()
    {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();

        foreach($_SESSION as $key) {
            unset($_SESSION[$key]);
        }
    }
}