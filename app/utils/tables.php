<?php

include_once __DIR__ . "/../assistant.php";

use Afterimage\core\Database;

// cria a tabela logerro
function create_logerro() {
    $sql = "CREATE TABLE IF NOT EXISTS logerro(
        codlogerro SERIAL NOT NULL PRIMARY KEY,
        localerro TEXT NOT NULL,
        erro TEXT NOT NULL,
        datahora timestamp with time zone NOT NULL
    )";
    (new Database())->execQuery($sql);
    echo "instrução " . __FUNCTION__ . " executada. \n";
}

if(isset($argv[1]) and $argv[1] == "-c") {
    create_logerro();
} else {
    echo "nenhum comando encontrado. \n";
}

?>