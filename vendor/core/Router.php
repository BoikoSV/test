<?php
namespace vendor\core;

class Router
{
    public static $currentRoute;
    public static $routes = [];
    public static $param;

    public static function add($route){
        self::$routes[] = $route;
    }

    /**
     * Метод принимает строку запроса url, разбивает на части, сравнивает запрос с патерном запросов хранящимся в поле $Routes
     * и если строка запроса соответствует имеющимнся роутеро то данные о вызываемом контроллере и методе записываются
     * в поле $currentRoute, если в строке есть параметры то они записываются в поле $param
     * @param $query
     */
    public static function parseQuery($query){
        $query = trim($query, '//');
        foreach (self::$routes as $route){
            if (preg_match($route[0], $query, $matches)){
                self::$currentRoute = $route[1];
                if (isset($matches[1])){
                    $param = explode('/' ,$matches[1]);
                    self::$param = [
                        $param[0] => $param[1]
                    ];
                }
            }else{
                echo 'Такой страницы не существует';die(); //TODO Написать функцию переадресации на страницу 404
            }
        }
    }

    /**
     * Возвращает обьект контроллера.
     * В созданный контроллер передаются параметры(название контроллера, вызываемый метод, параметры если такие есть)
     * @return mixed
     */
    public static function createController(){
        $controller = 'app\controllers\\' . self::$currentRoute['controller'] . 'Controller';
        $controlParametrs = self::$param ? : self::$param;
        if (class_exists($controller)){
            return new $controller(
                self::$currentRoute['controller'],
                self::$currentRoute['method'],
                $controlParametrs
            );
        }
            echo 'Такой страницы не существует';die(); //TODO Написать функцию переадресации на страницу 404
    }
}