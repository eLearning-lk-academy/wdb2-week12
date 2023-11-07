<?php 

include __DIR__."/db.php";
include __DIR__."/Helpers.php";
include __DIR__."/Autoloader.php";

// function to return view file
function view($view, $data=[]){
    $view = str_replace(".","/", $view);
    $viewPath = "../app/views/$view.php";
    
    /*
        $data = [
            "name" => "John",
            "age" => 20
        ];

        extract($data);

        $name = "John";
        $age = 20;
     */


    if(file_exists($viewPath)){
        extract($data);
        require_once "../app/views/template/header.php";
        require_once $viewPath;
        require_once "../app/views/template/footer.php";
    }else{
        die("View $view not found");
    }
}
function base_url($url){
    include __DIR__."/../config/config.php";
    return $site['url'].$url;
}