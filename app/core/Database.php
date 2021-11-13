<?php

namespace Afterimage\Core;
use Afterimage\Core\EnvReader;
use \PDO;

class Database extends PDO
{
    // atributo que recebe a conexão
    private $conn;

    // setando a conexão do banco de dados, parâmetros estão no arquivo .env
    public function __construct()
    {
        $this->conn = new PDO(
            'pgsql:host='. $_ENV['HOST_CONNECTION'] .';
            port='. $_ENV['PORT_CONNECTION'] .';
            dbname='. $_ENV['DBNAME_CONNECTION'] .';
            user='. $_ENV['USERNAME_CONNECTION'] .';
            password='. $_ENV['PASSWORD_CONNECTION'] .''
        );
    }
    
    // método que recebe um array e separa os elementos para fazer um bindparam
    private function setParams($statment, $parameters = [])
    {
        foreach($parameters as $key => $value)
        {
            $this->setParam($statment, $key, $value);
        }
    }

    // método que faz o bindparam
    private function setParam($statment, $key, $value)
    {
        $statment->bindParam($key, $value);    
    }

    // método que executa a instrução sql e retorna seu resultado
    private function queryCommand(string $rawQuery, $params = [])
    {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }

    // método que executa a instrução sql, os parametros são: a query crua e os elementos para bind 
    public function execQuery(string $rawQuery, $params = [])
    {
        $stmt = $this->queryCommand($rawQuery, $params);

        if(is_string($this->hasError($stmt))) {
            return $this->hasError($stmt); exit();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // método que verifica se a instrução retornou algum erro
    private function hasError($statment)
    {
        $stmt = $statment->errorInfo();
        if(is_string($stmt[2])) {
            return $stmt[2]; 
        }
        return false;
    }
}