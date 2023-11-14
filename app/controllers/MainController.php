<?php 

class MainController{
    public function __construct(){
    }

    public function setUserData($data, $value=null){
        if(is_array($data)){
            session("user", $data);
        }else{
            $userData = $this->userData();
            $userData[$data] = $value;
            session("user", $userData);

        }
    }

    public function isLoggedIn(){
        if($this->UserData("logged_in") && $this->UserData("id")){
            return true;
        }else{
            return false;
        }
    }

    public function isAdmin(){
        if($this->isLoggedIn() && $this->UserData("role")  == 1){
            return true;
        } 
        return false;
    }

    private function UserData($key=null){
        if(!session()){
            return false;
        }
        if($key){
            return session("user")[$key];
        }else{
            return session("user");
        }
    }


}