<?php

/**
 * Class for database connection
 *  
 * @author Weslley Araujo (WeslleyRAraujo)
 */

namespace App\Classes;
use Afterimage\Core\EnvReader;
use \PDO;

class Database extends PDO
{

    private $conn;

    /**
     * Set the database connection
     */
    public function __construct()
    {
        $this->conn = new PDO(
            $_ENV['DRIVER_CONNECTION'].'
            :host='. $_ENV['HOST_CONNECTION'] .';
            port='. $_ENV['PORT_CONNECTION'] .';
            dbname='. $_ENV['DBNAME_CONNECTION'] .';
            user='. $_ENV['USERNAME_CONNECTION'] .';
            password='. $_ENV['PASSWORD_CONNECTION'] .''
        );
    }
    
    /**
     * get the statment and parameters for call the method that make the bindParam
     * 
     * @param PDO $stmt, statment of connection
     * @param array $parameteres, parameters for bindParam
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
     * realize the bindParam
     * 
     * @param PDO $statment, statment of connection
     * @param string $key
     * @param string $value
     * 
     * @return void
     */
    private function setParam($statment, $key, $value)
    {
        $statment->bindParam($key, $value);    
    }

    /**
     * Execute query and return the connection status
     * 
     * @param string $rawQuery
     * @param array $params
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
     * call $this->queryCommand and check if returned error during connection
     * 
     * @param string $rawQuery
     * @param array $params
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
     * check if query returned a error
     * 
     * @param PDO $statment
     * 
     * @return string => has error
     * or
     * @return false => no error
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