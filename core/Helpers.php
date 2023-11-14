<?php

function dd($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

function session( $key = null, $value = null ){
    
    
    if(empty($_SESSION) && !empty($_SESSION[$key])){
        return false;
    }
    if($value){
        $_SESSION[$key] = $value;
    }elseif($key){
        return $_SESSION[$key];
    }else{
        return $_SESSION;
    }
}

function matchURL($path){
    $url = $_SERVER['REQUEST_URI'];
    $url = rtrim($url,'/');

    if ($path == $url) {
        return 'active';
    }
    return false;
}

function matchPath($path){
    $url = $_SERVER['REQUEST_URI'];
    $url = rtrim($url,'/');

    $routePattern = $path.'.*';
    $routePattern = '@^' . $routePattern . '$@';

    if(preg_match($routePattern, $url, $matches)){
        return 'menu-open';
    }
    return false;
}