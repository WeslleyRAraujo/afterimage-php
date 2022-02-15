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
        header('Content-type: application/json');
        echo json_encode([
                'message' => 'Thanks!!!!',
                'github' => 'WeslleyRAraujo',
                'arg' => $arg
        ], JSON_PRETTY_PRINT);
    }

    public function test($arg)
    {
        var_dump($arg);
        echo "test";
    }
}