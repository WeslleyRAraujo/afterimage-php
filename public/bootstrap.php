<?php
spl_autoload_register(function(string $file){
    
    $requireDirs = [__DIR__ . "/../app/controller/"];
    $parts = explode('\\', $file);
    foreach ($requireDirs as $dir) {
    	if(file_exists($dir .  end($parts) . ".php")) {
    		require_once $dir .  end($parts) . ".php";
    	}
    }
});
include_once __DIR__ . "/../app/src/Router.php";