<?php

/*
|----------------------------------------------------------------
| Default includes
|----------------------------------------------------------------
*/

// Paths for search the files in autoload, use like global var in bootstrap.php
$requireDirs = [
    __DIR__ . "/../app/controller/",
    __DIR__ . "/../app/class/"
];

include_once __DIR__ . "/src/Router.php";
include_once __DIR__ . "/functions/helpers.php";
include_once __DIR__ . "/http/routes/router.php";