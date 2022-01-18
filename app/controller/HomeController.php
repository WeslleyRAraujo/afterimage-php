<?php
/**
 * Controller example 
 * 
 * @author Weslley Araujo (WeslleyRAraujo)
 */
namespace App\Controller;

class HomeController
{
    public function index()
    {
        return view('home', [
            'title' => 'Tela Inicial',
            'breadcrumb' => ['Home']
        ]);
    }

    public function json()
    {
        header('Content-type: application/json');
        echo json_encode([
                'message' => 'Thanks!!!!',
                'github' => 'WeslleyRAraujo'
        ], JSON_PRETTY_PRINT);
    }
}