<?php

ini_set('error_reporting', E_ALL | E_STRICT);

define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

//require_once 'lib/coreReqs.php';

spl_autoload_register(function ($className) {
            $fullPath = DOCUMENT_ROOT . DIRECTORY_SEPARATOR
                    . str_replace('_', '/', strtolower($className)) . '.php';
            //echo $fullPath;
            
            if (is_readable($fullPath)) {
                include $fullPath;
            }
        });

$url = $_GET['url'];
$urlParts = explode('/', $url);
if (count($urlParts) !== 2 && count($urlParts) != 4) {
    header('Location: /lib/404.php');
    exit;
}

$className = 'Controller_' . ucfirst($urlParts[0]);
$methodName = $urlParts[1];

if (!class_exists($className)) {
    header('Location: /lib/404.php');
    exit;
}

$class = new $className($urlParts);

if (!method_exists($class, $methodName)) {
    header('Location: /lib/404.php');
    exit;
}
$class->$methodName();
