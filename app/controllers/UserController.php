<?php 


class UserController extends MainController{
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

        if($this->isLoggedIn()){
            dd('logged in');
        }

        $title = "User Login";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $userModel = new UserModel();
            $user = $userModel->getByEmail($_POST['email']);
            
            if($user){
               if(password_verify($_POST['password'], $user['password'])){
                $data = [
                    'id' => $user['id'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'name' => $user['first_name'].' '.$user['last_name'],
                    'email' => $user['email'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'logged_in' => true,
                ];
                $this->setUserData($data);
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

    public function passwordReset(){
        
        $title = "User Password Reset";

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $userModel = new UserModel();
            if($user = $userModel->getByEmail($_POST['email'])){
                $this->sendPasswordResetEmail($user);
            }else{
                echo 'email not found';
            }
        }

        view("user.password-reset", compact("title"));
    }

    public function verifyPasswordReset(){
        if(!empty($_GET['token'])){
            $token = $_GET['token'];
            $userModel = new UserModel();

            if($user = $userModel->getByToken($token)){

                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    
                    if($userModel->restPassword($user['id'], $_POST['password'])){
                        echo 'password reset success';
                        dd($user);
                    };
                }else{
                    $title = "User Password Reset Verify";
                    view("user.password-reset-verify", compact("title"));
                }
                
            }else{
                echo 'token not found';
            }
        }else{
            echo 'token not found';
            header("Location: /user/password-reset");
        }
        
    }

    private function sendPasswordResetEmail($user){
        try{
            require __DIR__."/../libraries/Mailer.php";
          
            $mailer = new Mailer();
           
            $mailer->to($user['email'], $user['first_name']);  
            $mailer->to("nuwan@nuwanr.dev", $user['first_name'].'dd');  
               
            $mailer->subject("Password Reset");
            $mailer->message("<h1>Click this link</h1> to reset your password: <a href='http://localhost:8080/user/password-reset-verify?token={$user['token']}'>Reset Password</a>");
    
            if($mailer->send()){
                dd('email sent');
                return true;
            }

        }catch(Exception $e){
            echo $mail->ErrorInfo;
            dd($e);    
        
        }
    }

    public function logOut(){
        session_destroy();
        header("Location: /");
    }
        



}