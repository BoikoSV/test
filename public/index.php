<?php
define("ROOT", $_SERVER['DOCUMENT_ROOT']);
use vendor\core\Router;

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    $file = ROOT . '/' . $class . '.php';
    var_dump($file);
    if (file_exists($file)){
        require_once $file;
    }
});

/**
 * Все доступные маршруты
 */
Router::add(['#^$/?#', ['controller' => 'main', 'model' => 'index']]);





