<?php

class Controller_Login extends BaseController
{
    public function __construct() {
        parent::__construct();
    }
    
    public function login(){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        $admin = new Model_Admin();
        $user = $admin->authenticate($username, $password);
//        echo "<pre>";
//        print_r($user);
//        foreach ($user as $key => $value){
//            echo $user->$key . "<br />";
//        }
        
        if($user){
            $this->loginUser($user->id);
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
