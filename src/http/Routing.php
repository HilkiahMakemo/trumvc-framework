<?php

namespace TruMVC\Http;

use FastRoute\Route;
use FastRoute\RouteCollector;

class Routing extends RouteCollector
{
    private $router, $routes = [];

    public function __construct($routes)
    {
        $this->router = RouteCollector::class;

        foreach($routes as $route){
            $r = $this->setRoutes($route);

            if(is_int($r)) continue;

            $this->routes[] = $r;
        }        
        

        dump($this);
    }

    public function setRoutes($route)
    {
        if(is_dir($route)) 
            $this->setRoutes($route);
        else 
            return require $route;
    }

    public function getRoutes()
    {
        // foreach($this->r){
            
        // }
    }

    public function dispatch(Closure $router)
    {
        return \FastRoute\simpleDispatcher($router);         
    }
}