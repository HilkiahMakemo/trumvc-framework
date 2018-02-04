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
            $name = pathinfo($route, PATHINFO_FILENAME);

            $r = $this->setRoutes($route, $this->routes);

            if(is_int($r) || is_null($r)) continue;

            $this->routes[$name] = $r;
        } 
    }

    public function setRoutes($route, $arr = [])
    {
        if(is_dir($route)){ 
            $this->setRoutes($route, $arr);
        } 
        elseif(Str($route)->contains('.json')) {
            $arr = $this->parseJson($route);
        }
        elseif(Str($route)->endsWith('.php')) {
            $arr = $this->parseArray($route);
        }
        return $arr;
    }

    public function parseJson($string)
    {
        $json = file_get_contents($string);
        return json_decode($json, true);
    }

    public function parseArray($string)
    {
        return require $string;
    }

    public function parseYaml()
    {
        # code...
    }

    public function getRoutes()
    {
        // foreach($this->r){
            
        // }
    }

    public function dispatch(Closure $router)
    {
        dump($this->routes);
        return \FastRoute\simpleDispatcher($router);         
    }
}