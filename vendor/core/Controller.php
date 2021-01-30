<?php
namespace vendor\core;

namespace vendor\core;


abstract class Controller
{
    public $controller;
    public $method;

    public function __construct($controller, $method){
        $this->controller = $controller;
        $this->method = $method;
    }
}