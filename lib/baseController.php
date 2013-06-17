<?php

class BaseController
{
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
