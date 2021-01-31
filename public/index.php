<?php
define("ROOT", $_SERVER['DOCUMENT_ROOT']);
use vendor\core\Router;
use app\controllers;
use vendor\core\DB;
use app\controllers\MainController;
use \vendor\core\Curl;

/**
 * Функция автозагрузки классов
 */
spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    $file = ROOT . '/' . $class . '.php';
    if (file_exists($file)){
        require_once $file;
    }
});

/**
 * Получение строки запроса с адрессной строки браузера
 */
$query = $_SERVER['REQUEST_URI'];


/**
 * Сюда будут писаться все маршруты которые будут обрабатываться приложением.
 * В начале идет шаблон регулярного выражения, которое будет характеризовать,
 * строку запроса и масив с названием класса и метода который обработает этот запрос.
 */
Router::add(['#^(api)$#i', ['controller' => 'Curl', 'method' => 'recordingData']]); //Маршрут для api
Router::add(['#^.*(user=\d+)$#i', ['controller' => 'Main', 'method' => 'indexOne']]); //Маршрут для фильтра
Router::add(['#^$#i', ['controller' => 'Main', 'method' => 'indexAll']]);           //Маршрут для главной страницы


//$curl = new controllers\CurlController();
//var_dump($curl->recordingData());die();



/**
 * Передается строка запроса роутеру
 */
Router::parseQuery($query);


/**
 * Возвращает обьект контроллера
 */
$controller = Router::createController();
/**
 * Записывает вызываемый метод обьекта в переменную
 */
$method = $controller->method;
//var_dump($controller->method);
/**
 * Вызов метода соответсвующего запросу
 */
$arr = $controller->$method();
$data = $arr[0];
$users = $arr[1];
//var_dump($users);
require_once ROOT . '/views/content.html';

