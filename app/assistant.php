<?php

spl_autoload_register(function(string $file){
    
    $parts = explode('\\', $file);
    $class = end($parts);

    if(file_exists(__DIR__ . "/core/{$class}.php")){
        require_once __DIR__ . "/core/{$class}.php";
    }
    elseif(file_exists(__DIR__ . "/class/{$class}.php")){
        require_once __DIR__ . "/class/{$class}.php";
    }
    elseif(file_exists(__DIR__ . "/controller/{$class}.php")){
        require_once __DIR__ . "/controller/{$class}.php";
    }
    else{
        throw new Exception(sprintf("Não poi possível incluir o arquivo %s", $class));
    }
});

include_once __DIR__ . "/core/functions/view.php";

(new Afterimage\core\EnvReader())->load();

?>