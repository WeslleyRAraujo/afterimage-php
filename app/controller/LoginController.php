<?php

namespace App\Controller;

use Afterimage\Core\Controller;
use Afterimage\Core\Session;

use App\Models\Usuario;

class LoginController extends Controller
{

    public function index()
    {
        if(!Session::get(['logged' => true])) {
            return view('login', ['title' => 'login']);
        } else {
            return header("location: ./");
        }
    }

    public function auth()
    {
        $user = new Usuario();
        $data = $user->findLogin();

        if(isset($data['senha'], $data['login'])) {
            $data['logged'] = true;
            Session::set($data);
            header("location: /");
        } else {
            return header("location: /login?not-allowed");
        }
    }

    public function exit()
    {
        Session::kill();
        return header("location: /login");
    }
}

?>