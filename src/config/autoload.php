<?php 

spl_autoload_register(function($class) {
    $file = str_replace("src\\", "src", $class);

    $file = str_replace("\\", DIRECTORY_SEPARATOR, $file) . ".php";

    if(file_exists($file)) {
        require $file;
    }
});