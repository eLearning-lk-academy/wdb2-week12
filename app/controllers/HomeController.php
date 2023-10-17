<?php

class HomeController {
    public function index() {
        $title = "Home Page";
        $content = "This is the home page";
        return view("home.index", compact("title","content"));
    }

    public function about() {
       return view("home.about");
    }

    public function save(){
        echo 'HomeController save';
    }

    public function add(){
        echo 'HomeController add';
    }

    public function page($id, $slug, $id3){
        echo 'HomeController page ' . $id.' '. $slug .''.$id3;
    }
}