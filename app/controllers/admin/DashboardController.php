<?php 

class DashboardController extends AdminController{

    public function index(){
        $title = "Dashboard";
        return adminView("dashboard", compact("title"));
    }
}