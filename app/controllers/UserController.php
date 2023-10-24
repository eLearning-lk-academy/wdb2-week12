<?php 

class UserController{
    public function index($id){
        $user = new UserModel();
        // $user = $user->getUser(1);
        $data = $user->get($id);
        
        var_dump($data);
    }

    public function register(){
        $title = "User Register";

        view("user.register", compact("title"));
    }

    public function login(){
        $title = "User Login";

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $userModel = new UserModel();
            $user = $userModel->getByEmail($_POST['email']);
            
            if($user){
               if(password_verify($_POST['password'], $user['password'])){
                echo 'Login Success';
                dd($user);
               }else{
                echo 'password not match';
               }
            }
        }

        view("user.login", compact("title"));
    }

    public function add(){
        $data = [
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'username' => $_POST['username'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT )
        ];
        $user = new UserModel();
        $id = $user->add($data);
        if($id){
            header("Location: /user/".$id);
        }else{
            header("Location: /user/register");
        }
    }

}