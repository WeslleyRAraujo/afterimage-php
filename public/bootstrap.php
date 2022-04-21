<?php
/*
|--------------------------------------------------------------------------
| Start autoload, include dependencies of /app
|--------------------------------------------------------------------------
*/

// Autoload
spl_autoload_register(function(string $file){
    global $requireDirs;
    $parts = explode('\\', $file);
    foreach ($requireDirs as $dir) {
    	if(file_exists($dir .  end($parts) . ".php")) {
    		require_once $dir .  end($parts) . ".php";
    	}
    }
});

include_once __DIR__ . "/../app/share.php";