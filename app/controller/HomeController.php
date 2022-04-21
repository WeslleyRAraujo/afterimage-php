<?php

namespace App\Controller;

class HomeController
{
    public function index()
    {
        require_once __DIR__ . "/../views/home.php";
    }

    public function message($arg = null)
    {
        require_once __DIR__ . "/../views/thanks.php";
    }
}
