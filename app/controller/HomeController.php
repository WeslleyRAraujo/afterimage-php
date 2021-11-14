<?php

namespace App\Controller;

use Afterimage\Core\Controller;
use Afterimage\Core\Session;
use Afterimage\Core\Route;

class HomeController extends Controller
{
    public function index()
    {
        if(!Session::get(['logged' => true])) {
            return header("location: /login");
        } else {
            return view('home', ['title' => 'Home']);
        }
    }
}

?>