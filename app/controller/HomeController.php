<?php

namespace App\Controller;

class HomeController
{
    public function index()
    {
        require_once __DIR__ . "/../views/home.html";
    }

    public function json($arg = null)
    {
        require_once __DIR__ . "/../views/thanks.php";
    }

    public function test($arg)
    {
        var_dump($arg);
        echo "test";
    }
}