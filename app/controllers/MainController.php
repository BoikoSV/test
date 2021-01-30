<?php
namespace app\controllers;
use app\models\Post;
use vendor\core\Controller;

class MainController extends Controller
{
    public $params;


    public function __construct($controller, $method, $params = [])
    {
        parent::__construct($controller, $method);
        $this->params = $params;
    }

    /**
     * Метод который достает все записи из базы данных
     * @return array
     */
    public function indexAll(){
        $post = new Post();
        $arrPost = $post->getAll();
        return $arrPost;
    }

}