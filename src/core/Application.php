<?php

namespace TruMVC\Core;

use DI\Container;
use DI\ContainerBuilder;

class Application extends ContainerBuilder
{
    private $container;
    private static $instance;

    public static function instance()
    {
        if(empty(static::$instance)){
            static::$instance = new Application();
            $container = static::$instance->build();
            static::$instance->container = $container;
        }
        return static::$instance;
    }

    public function set($name, $handler)
    {
        $this->container->set($name, $handler);
        return $this;
    }

    public function get($name)
    {
        return $this->container->get($name);
    }

    public function response()
    {
        dump($this);
    }

}