<?php

namespace TruMVC\Core;

class Configurator extends Collection
{
    protected $configs = [];

    public function __construct($configs = [])
    {
        foreach($configs as $config){
            $name = str_replace('.php', '', basename($config));
            
            $value = json_decode(json_encode(require $config));
            
            $this->configs[$name] = $value;
        }
    }

    
}
