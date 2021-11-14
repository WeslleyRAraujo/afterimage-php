<?php

namespace App\Models;

use Afterimage\Core\Http;
use Afterimage\Core\Database;

class Usuario extends Http
{
    private $table = 'usuario';

    private $data;

    public function findLogin()
    {
        $user = $this->getResponseData();

        $sql = "SELECT * FROM {$this->table} WHERE login = :login AND senha = :senha";

        $user = (new Database())->execQuery($sql, [
            'login' => $user['login'],
            'senha' => $user['password']
        ]);

        if(isset($user[0])) {
            return $user[0]; 
        } else {
            return [];
        }
    }
}

