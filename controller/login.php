<?php

class Controller_Login extends Controller_BaseController
{
    public function __construct($urlParts) {
        parent::__construct($urlParts);
    }
    
    public function login(){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        $admin = new Model_Admin();
        $user = $admin->authenticate($username, $password);
//        echo "<pre>";
//        print_r($user);
        
        if($user){
            $this->loginUser($user);
            unset($_SESSION['message']);
            header("Location: /admin/index");
            exit;
        } else{
            $_SESSION['message'] = "Invalid username or password";
            header("Location: index");
            exit;
        }
    }

    public function index(){
        $this->_render();
    }
}
