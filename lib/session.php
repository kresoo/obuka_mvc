<?php

class Session {

    private $logged_in;
    public $admin_id;
    public $message;

    public function __construct() {
        session_start();
        $this->check_login();
    }

    public function is_logged_in() {
        return $this->logged_in;
    }

    public function login($user) {
        $this->admin_id = $_SESSION['$admin_id'] = $user->id;
        $this->logged_in = true;
    }

    public function logout() {
        unset($_SESSION['admin_id']);
        $_SESSION['cart'] = "";
        unset($this->admin_id);
        $this->logged_in = false;
    }

    private function check_login() {
        if (isset($_SESSION['admin_id'])) {
            $this->admin_id = $_SESSION['admin_id'];
            $this->logged_in = true;
        } else {
            $this->logged_in = false;
        }
    }

}
?>