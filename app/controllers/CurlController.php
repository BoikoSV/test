<?php


namespace app\controllers;

use vendor\core\Controller;
use vendor\core\DB;
use app\models\CurlModel;

/**
 * Контроллер Curl
 * Class CurlController
 * @package app\controllers
 */
class CurlController extends Controller
{
    /**
     * Обьекты json преобразует в массив и передает базе данных
     */
    public function recordingData(){
        $curlModel = new CurlModel();
        $arr = $curlModel->getData();
        $db = DB::getInstance();
        foreach ($arr as $value){
            $db->insertData($value);

        }
        header("Location: /");
    }
}