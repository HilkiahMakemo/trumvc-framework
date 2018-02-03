<?php

use TruMVC\Core\Application;


if(!function_exists('app')){
    function app($name, $handler = null)
    {
        $App = Application::instance();
        
        if(empty($handler)){
            return $App->get($name);
        }
        $App->set($name, $handler);
        return $App;
    }
}