<?php

/**
 * Whoops Error Handler Class
 * 
 * @author Weslley R. de Araujo (WeslleyRAraujo)
 */

namespace App\Classes;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\PlainTextHandler;
use Whoops\Handler\JsonResponseHandler;

class Whoops
{
    public static function run()
    {
        $whoops = new Run();

        switch ($_ENV['WHOOPS_HANDLER_ERROR']) {
            case 'pretty':
                $whoops->pushHandler(new PrettyPageHandler());
                break;
            case 'plain':
                $whoops->pushHandler(new PlainTextHandler());
                break;
            case 'json':
                $whoops->pushHandler(new JsonResponseHandler());
                break;
            default:
                $whoops->pushHandler(new PlainTextHandler());
                break;
        }

        $whoops->register();
    }
}