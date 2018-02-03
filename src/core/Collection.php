<?php

namespace TruMVC\Core;

class Collection implements \ArrayAccess
{
    private $collection = [];

    public function __set($key, $value)
    {
        return $this->offsetSet($key, $value);
    }

    public function __get($key)
    {
        return $this->offsetGet($key);
    }   
    
    public function __call($method, $params = null)
    {
        
        if($method == 'get') $method = 'offsetGet';
        if($method == 'set') $method = 'offsetSet';
        if($method == 'has') $method = 'offsetExists';
        
        $func = array($this, $method);
        return call_user_func_array($func, $params);
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
