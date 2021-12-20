<?php
/**
 * Classe responsável por controlar o acesso
 * 
 * @author Weslley Araujo (WeslleyRAraujo)
 */

namespace Afterimage\Core;

use Afterimage\Core\Session;

class Sentinel
{
    /**
     * Só autoriza o código continuar caso a sessão atenda os requisitos
     *
     * @param $session, chave da sessão
     * @param $value, valor da sessão
     * @param $redirect, rota de redirecionamento caso $session[$value] não atenda os requisitos
     * 
     * @return true|void
     */
    public static function justAllow($session, $value, $redirect) 
    {
        if(Session::getValue($session) == $value) {
            return true;
        }else {
            header("location: {$redirect}"); die();
        }
    }
}