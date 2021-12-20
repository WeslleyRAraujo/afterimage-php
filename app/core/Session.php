<?php
/**
 * Classe responsável pelas atividades de sessão
 * 
 * @author Weslley Araujo (WeslleyRAraujo)
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

    /**
     * Cria novos valores de sessão
     * 
     * @param array $sessionArr, chaves e valores para criar índices na sessão
     * 
     * @throws Exception
     * or
     * @return void
     */
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

    /**
     * Retorna os os valores de determinado item de sessão
     * 
     * @param string $session, chave da sessão a ser consultada
     * 
     * @return string|int|float|bool
     * or 
     * @return false
     */
    public static function getValue($session)
    {
        if(isset($_SESSION[$session])) {
            return $_SESSION[$session];
        } else {
            return false;
        }
    }

    /**
     * mata todas a sessões, recomendação diretamente do manual do PHP 
     * https://www.php.net/manual/pt_BR/function.session-destroy.php
     * 
     * @return void
     */
    public static function kill()
    {
        $_SESSION = [];
        if(ini_get("session.use_cookies")) {
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