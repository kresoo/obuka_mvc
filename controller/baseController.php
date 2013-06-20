<?php

class Controller_BaseController
{
        
    public $logged_in;
    public $admin_id;
    public $params = array();
    
    public function __construct($urlParts)
    {
         session_start();
         $this->check_login();
         $this->genParams($urlParts);
    }
    
     public function genParams($params)
    {
        $this->params['controller'] = $params[0];
        $this->params['action'] = $params[1];
        
        if (count($params) === 4) {
            $this->params[$params[2]] = $params[3];
        }
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
        
        if (!empty($params)) {
            extract($params);
        }

        ob_start();

        include DOCUMENT_ROOT . DIRECTORY_SEPARATOR
                . 'view' . DIRECTORY_SEPARATOR
                . strtolower($this->params['controller']) . DIRECTORY_SEPARATOR
                . strtolower($this->params['action']) . '.php';
        
        $content = ob_get_clean();
        
        include DOCUMENT_ROOT . DIRECTORY_SEPARATOR
                . 'view' . DIRECTORY_SEPARATOR
                . 'baseView.php';
        
        ob_end_flush();
    }
}
