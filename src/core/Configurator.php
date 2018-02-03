<?php

namespace TruMVC\Core;

class Configurator implements \ArrayAccess
{
    protected $configs = [];

    public function __construct($configs = [])
    {
        foreach($configs as $config){
            $this->configs[] = require $config;
        }
    }

    public function offsetExists($name)
    {
        return array_key_exists($name, $this->configs);
    } 

    public function offsetGet($name)
    {
        return $this->configs[$name];
    }

    public function offsetSet($name, $value)
    {
        $this->configs[$name] = $value;
    }

    public function offsetUnSet($name)
    {
        unset($this->configs[$name]);
    }
}
