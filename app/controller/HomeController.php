<?php

namespace App\Controller;

class HomeController
{
    public function index()
    {
        require_once __DIR__ . "/../views/home.html";
    }

    public function json()
    {
        header('Content-type: application/json');
        echo json_encode([
                'message' => 'Thanks!!!!',
                'github' => 'WeslleyRAraujo'
        ], JSON_PRETTY_PRINT); die();
    }
}