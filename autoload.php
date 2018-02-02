<?php



$Loader = function($DIR) use(&$Loader)
{
    $DS = DIRECTORY_SEPARATOR;

    $Paths = glob($DIR.$DS."*.php", GLOB_NOSORT);

    foreach ($Paths as $path) {

        if(is_dir($path)){
            $Loader($path);
        } else {
            require_once $path;
        }
    }

};

$Loader(dirname(__FILE__));