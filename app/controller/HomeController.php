<?php

namespace App\Controller;

class HomeController
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