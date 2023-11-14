<?php

$routes = [
    '/'  => ['HomeController', 'index' ],

    '/user/:id' => ['UserController', 'index' ],
    '/user/register' => ['UserController', 'register' ],
    'POST:/user/register' => ['UserController', 'add' ],

    '/user/login' => ['UserController', 'login' ],
    '/user/logout' => ['UserController', 'logOut' ],
    'POST:/user/login' => ['UserController', 'login' ],

    '/user/password-reset' => ['UserController', 'passwordReset' ],
    'POST:/user/password-reset' => ['UserController', 'passwordReset' ],

    '/user/password-reset-verify' => ['UserController', 'verifyPasswordReset' ],
    'POST:/user/password-reset-verify' => ['UserController', 'verifyPasswordReset' ],


    // admin

    '/admin' =>['admin/DashboardController', 'index' ],
    
];

$url = $_SERVER['REQUEST_URI'];
// remove query string
$url = explode('?', $url)[0];




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

            $controllerPath = explode('/', $action[0]);
            $controllerName = $controllerPath[count($controllerPath)-1];
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