<?php

use FastRoute\RouteCollector as Router;

if(!function_exists('route')){
    function route($path)
    {
        return new Router($path, '');
    }
}



// return FastRoute\simpleDispatcher(function(Router $r) {
//     $r->addRoute('GET', '/users', IndexController::class);
//     // {id} must be a number (\d+)
//     $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
//     // The /{title} suffix is optional
//     $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
// });