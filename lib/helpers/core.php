<?php

use TruMVC\Core\Application;

$App = Application::instance();

if(!function_exists('app')){
    function app($name, $handler = null)
    {
        if(empty($handler)){
            return $App->get($name);
        }
        $App->set($name, $handler);
        return $App;
    }
}