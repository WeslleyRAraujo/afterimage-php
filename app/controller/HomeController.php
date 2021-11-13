<?php

namespace App\Controller;

use Afterimage\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'title' => 'Inicio', 
            'mainTitle' => 'Home Page'
        ]);
    }
}

?>