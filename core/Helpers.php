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