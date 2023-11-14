<?php 

class DashboardController extends AdminController{

    public function index(){
        $title = "Dashboard";
        return view("admin.dashboard", compact("title"));
    }
}