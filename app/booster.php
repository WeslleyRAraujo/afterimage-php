<?php

require_once __DIR__ . "/core/EnvReader.php";
require_once __DIR__ . "/core/functions/common.php";

(new Afterimage\EnvReader())->load();

spl_autoload_register(function(string $file){
    
    $parts = explode('\\', $file);
    $class = end($parts);

    // treatment for commas and spaces
    $includeCommas = explode(',', $_ENV['LOADER_FOLDERS']);
    $includesSpace = implode(' ', $includeCommas);
    $includes = explode(' ', $includesSpace);

    foreach($includes as $include) {
        $file = __DIR__ . "/" . $include . "/" . $class . ".php";
        try {
            if(file_exists($file)) {
                require_once $file;
            }
        } catch (Exception $e) {
            throw new Exception(sprintf("Não foi possível incluir o arquivo %s", $file));
        }
    }
});

if($_ENV['DISPLAY_ERRORS'] == 'yes') {
    \App\Classes\Whoops::run();
} else {
    ini_set('display_errors', 0);
}

(new Afterimage\Session);

?>