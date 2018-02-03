<?php



$Loader = function($DIR) use(&$Loader)
{
    $DS = DIRECTORY_SEPARATOR;

    $Paths = glob($DIR.$DS."*", GLOB_NOSORT);

    foreach ($Paths as $path) {

        if(strpos($path, '.php') !== false){
            require_once $path;
        } elseif(is_dir($path)) {
            $Loader($path);
        } else {
            continue;
        }       
    }

};

$Loader( dirname(__FILE__) );