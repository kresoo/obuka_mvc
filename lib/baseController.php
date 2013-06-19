<?php

class BaseController
{
        
    public $logged_in;
    public $admin_id;
    
    public function __construct()
    {
         session_start();
         $this->check_login();
    }

    public function is_logged_in() {
        return $this->logged_in;
    }

    public function loginUser($user) {
        $this->admin_id = $_SESSION['admin_id'] = $user->id;
        $this->logged_in = true;
    }

    public function logoutUser() {
        unset($_SESSION['admin_id']);
        $_SESSION['cart'] = "";
        unset($this->admin_id);
        $this->logged_in = false;
    }

    protected function check_login() {
        if (isset($_SESSION['admin_id'])) {
            $this->admin_id = $_SESSION['admin_id'];
            $this->logged_in = true;
        } else {
            $this->logged_in = false;
        }
    }

    
    protected function _render($params = array())
    {
        global $urlParts;
        
        if (!empty($params)) {
            extract($params);
        }
        
        ob_start();
        
        include DOCUMENT_ROOT . DIRECTORY_SEPARATOR
                . 'view' . DIRECTORY_SEPARATOR
                . strtolower($urlParts[0]) . DIRECTORY_SEPARATOR
                . strtolower($urlParts[1]) . '.php';
        
        $content = ob_get_clean();
        
        include DOCUMENT_ROOT . DIRECTORY_SEPARATOR
                . 'lib' . DIRECTORY_SEPARATOR
                . 'baseView.php';
        
        ob_end_flush();
    }
}
