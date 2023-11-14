<?php 

class AdminController extends MainController{
    public function __construct(){
        if(!$this->isAdmin()){
            dd("not admin");
        }
    }

    public function index(){
        return adminView("login");
    }
}