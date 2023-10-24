<?php

$routes = [
    '/'  => ['HomeController', 'index' ],
    '/about' => ['HomeController', 'about'],
    '/save' => ['HomeController', 'save' ],
    'POST:/save' => ['HomeController', 'add'],
    '/page/:id' => ['HomeController', 'page'],
    'POST:/page/:id/:slug/:id' => ['HomeController', 'page'],

    
    '/user/:id' => ['UserController', 'index' ],
    '/user/register' => ['UserController', 'register' ],
    'POST:/user/register' => ['UserController', 'add' ],

    '/user/login' => ['UserController', 'login' ],
    'POST:/user/login' => ['UserController', 'login' ],
];

$url = $_SERVER['REQUEST_URI'];



foreach ($routes as $route => $action ) {

    $method = 'GET';

    if (strpos($route, 'POST:') !== false) {
        $routeDef = explode(':', $route);
        $method = $routeDef[0];
        $route = str_replace($method . ':', '', $route);
    }
    
    $routePattern = str_replace(':id', '([0-9]+)',$route);
    $routePattern = str_replace(':slug', '([A-z0-9\-_]+)',$routePattern);
    $routePattern = '@^' . $routePattern . '$@';

    // if ($url == $route){
    if (preg_match($routePattern, $url, $matches)) {
        array_shift($matches);
        
        
        if($_SERVER['REQUEST_METHOD'] == $method){
            $controllerName = $action[0];
            $method = $action[1];
            $controller = new $controllerName();
            // $controller->$method($matches[0]);
            call_user_func_array([$controller, $method], $matches);
            return;
        }else{
            http_response_code(403);
            $error = 'Method not allowed';
        }
    }else{
        http_response_code(404);
        $error = 'No Route Found';
    }
}

if (!empty($error)){
    echo $error;
    return;
}