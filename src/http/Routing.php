<?php

namespace TruMVC\Http;

use FastRoute\Route;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher as dispatcher;

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

    public function getHandler($handler)
    {
        return function() use($handler){
            if($handler instanceof \Closure) return $handler();
            if(is_array($handler)) return implode("::", $handler);
        };
    }

    public function dispatch()
    {
        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $this->router = dispatcher(function() {

            foreach($this->routes as $name => $routes){
                foreach($routes as $url => $route){
                    $handler = $this->getHandler($route['class']);
                    if($handler == null || $handler() == null) continue;
                    $method = strtoupper($route['method']);
                    if($method == 'ANY'){
                        $method = ['GET','POST', 'PUT','DELETE', 'PATCH'];
                    }                    
                    $this->addRoute($method, $url, $handler);
                }
            }
            die();

        })->dispatch($httpMethod, $uri);

        // $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($this->router[0]) {
        case \FastRoute\Dispatcher::NOT_FOUND:
            // ... 404 Not Found
            break;
        case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $allowedMethods = $this->router[1];
            // ... 405 Method Not Allowed
            break;
        case \FastRoute\Dispatcher::FOUND:
            $handler = $this->router[1];
            $vars = $this->router[2];
            dump($handler, $vars);
            break;
        }        
    }
}