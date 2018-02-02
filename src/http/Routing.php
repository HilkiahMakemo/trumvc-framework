<?php

namespace TruMVC\Http;
use FastRoute\RouteCollector;

class Routing extends RouteCollector
{
    private $router, $routes = [];

    public function __construct($router)
    {
        $this->router = $router;
        $routes = glob($this->router."*.php", GLOB_NOSORT);

        foreach($routes as $route){
            $this->routes[] = $this->setRoutes($route);
        }   
    }

    public function setRoutes($route)
    {
        if(is_dir($route)) 
            $this->setRoutes($route);
        else 
            return require $route;
    }

    public function dispatch(Closure $router)
    {
        return \FastRoute\simpleDispatcher($router);         
    }
}