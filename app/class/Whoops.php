<?php

/**
 * Whoops Error Handler Class
 * 
 * @author Weslley R. de Araujo (WeslleyRAraujo)
 */

namespace App\Classes;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

class Whoops
{
    public static function run()
    {
        $whoops = new Run();
        $whoops->pushHandler(new PrettyPageHandler());
        $whoops->register();
    }
}