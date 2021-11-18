<?php

/**
 * Classe responsável pela conexão com o banco de dados e execução das instruções
 *  
 * @author Weslley Araujo (WeslleyRAraujo)
 */

namespace Afterimage\Core;
use Afterimage\Core\EnvReader;
use \PDO;

class Database extends PDO
{

    private $conn;

    /**
     * Seta as configurações de conexão com o banco de dados
     */
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
    
    /**
     * recebe o statment e os parâmetros para criar o bindParam dos argumentos
     * 
     * @param PDO $stmt, estado atual da conexão 
     * @param array $parameteres, parâmetros para fazer o bindParam
     * 
     * @return void
     */
    private function setParams($statment, $parameters = [])
    {
        foreach($parameters as $key => $value)
        {
            $this->setParam($statment, $key, $value);
        }
    }

    /**
     * realiza o bindParam de fato
     * 
     * @param PDO $statment, estado atual da conexão
     * @param string $key, chave para fazer o bind do parâmetro
     * @param string $value, valor para ser atribuido a chave
     * 
     * @return void
     */
    private function setParam($statment, $key, $value)
    {
        $statment->bindParam($key, $value);    
    }

    /**
     * Executa a instrução sql de fato e retorna o estado da conexão
     * 
     * @param string $rawQuery, query crua
     * @param array $params, parâmetros para o bindparam
     * 
     * @return PDO
     */
    private function queryCommand($rawQuery, $params = [])
    {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Chama o método queryCommand e verifica se foi retornado algum erro durante a execução
     * 
     * @param string $rawQuery, query crua
     * @param array $params, parâmetros para o bindparam
     * 
     * @return PDO::hasError
     * or 
     * @return PDO::fetchAll => 'PDO::FETCH_ASSOC'
     * 
     */
    public function execQuery(string $rawQuery, $params = [])
    {
        $stmt = $this->queryCommand($rawQuery, $params);

        if(is_string($this->hasError($stmt))) {
            return $this->hasError($stmt); exit();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Verifica se a consulta retornou algum erro
     * 
     * @param PDO $statment, estado atual da conexão
     * 
     * @return string => com erro
     * or
     * @return false => sem erro
     */
    private function hasError($statment)
    {
        $stmt = $statment->errorInfo();
        if(is_string($stmt[2])) {
            return $stmt[2]; 
        }
        return false;
    }
}