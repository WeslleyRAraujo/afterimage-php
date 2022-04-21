<?php

if(!function_exists('asset')) {
    function asset($path) {
        $prefix = "/";
        if(file_exists(__DIR__ . "/../settings.ini")) {
            $prefix = parse_ini_file(__DIR__ . "/../settings.ini", true);
            $prefix = $prefix['prefix_url'];
        }
        $path = ltrim($path, '/');
        echo $prefix . $path;
    }
}

if(!function_exists('route')) {
    function route($route) {
        $route = rtrim($route, '/');
        $prefix = "";
        if(file_exists(__DIR__ . "/../settings.ini")) {
            $prefix = parse_ini_file(__DIR__ . "/../settings.ini", true);
            $prefix = $prefix['prefix_url'];
        }
        echo $prefix . $route;
    }
}