<?php

use TruMVC\Core\Application;

if(!function_exists('view')){
    
    function view( $file, $data = null )
    {
        $App = Application::instance();

        $view = $App->get('viewer')->show($file);

        if($data != null){
            $view = $view->with($data);
        }
        return $view;
    }
}