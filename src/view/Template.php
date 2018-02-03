<?php

namespace TruMVC\View;

use Twig_Environment;
use Twig_Loader_Filesystem;

class Template extends Twig_Environment
{
    private $loader, $viewer, $template, $extension;

    public function __construct($views)
    {
        $this->loader = new Twig_Loader_Filesystem((array)$views->templates);
        $this->extension = $views->extension ?: '.php';
        parent::__construct($this->loader, (array)$views->settings);
        return $this;
    }

    public function path($view_file)
    {
        if(strpos($view_file, ":") !== false){
            $view_parts = explode("::", $view_file);
            list($namespace, $view_path) = $view_parts;
        } else {
            $namespace = null;  $view_path = $view_file;
        }
        if($namespace !== null) $namespace = "@$namespace/";
        $view_path = str_replace(".", "/", $view_path);
        return $namespace.$view_path.$this->extension;
    }

    public function show($view_file, $data = [])
    {
        $view_file = $this->path($view_file);

        $this->template = $this->load($view_file);
        
        if($data !== null || empty($view_file)) return $this;

        return $this->template->with($data);
    }

    public function with(Array $data)
    {
        return $this->template->render($data);
    }

    public function make($view_file, $data = [])
    {
        return $this->viewer->render($view_file, $data);
    }
    
}
