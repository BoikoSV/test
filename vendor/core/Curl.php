<?php


namespace vendor\core;
/**
 * Библиотека Curl Используеться для получение данныех с api
 * Class Curl
 * @package vendor\core
 */

class Curl
{
    private $link = 'https://jsonplaceholder.typicode.com/posts';
    private $curl;

    /**
     * Настройки Curl
     * Curl constructor.
     */
    public function __construct(){
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_URL,$this->link);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER,1);
    }

    /**
     * Достать все данные
     * @return bool|string
     */
    public function fetch(){
        $result = curl_exec($this->curl);
        curl_close ($this->curl);
        return $result;
    }
}