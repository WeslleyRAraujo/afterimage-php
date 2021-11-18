<?php
/**
 * Controlador exemplo da rota /
 * 
 * @author Weslley Araujo (WeslleyRAraujo)
 */
namespace App\Controller;

use Afterimage\Core\Http;
use Afterimage\Core\Sentinel;

class HomeController
{
    /**
     * Retorna view home localizada em /app/views/home.twig
     * 
     * @return Twig::display
     */
    public function index()
    {
        return view('home', [
            'title' => 'Tela Inicial',
            'breadcrumb' => ['Home']
        ]);
    }

    /**
     * Mostra um json
     */
    public function json()
    {
        echo json_encode([
                'message' => 'Thanks!!!!',
                'github' => 'WeslleyRAraujo'
        ], JSON_PRETTY_PRINT);
    }
}