<?php
/**
 * Class for access control
 * 
 * @author Weslley Araujo (WeslleyRAraujo)
 */

namespace Afterimage;

use Afterimage\Session;

class Sentinel
{
    /**
     * continue the execution case the connection meet the requirements
     *
     * @param $session, session key
     * @param $value, session value
     * @param $redirect, route for redirect case $session[$value] don't meet the requirements
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