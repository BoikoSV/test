<?php


namespace app\models;
use \vendor\core\Curl;

class CurlModel
{
    public $objCurl;

    /**
     * В конструкторе создается новый обьект Curl и записывается в свойство $objCurl
     * CurlModel constructor.
     */
    public function __construct(){
        $this->objCurl = new Curl;
    }

    /**
     * Достает данные с курл методом fetch(), преобразует в массив и возвращает
     */
    public function getData(){
        $arrData = $this->objCurl->fetch();
        return json_decode($arrData, true);
    }
}