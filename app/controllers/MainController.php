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
        $arrUsers = $post->getUsers();
        return [$arrPost, $arrUsers];
    }

    /**
     * Метод который выводит посты одного пользователя на страницу
     * @return array
     */
    public function indexOne()
    {
        $posts = new Post();
        $arrPosts = $posts->getOneUserPosts($this->params);
        $arrUsers = $posts->getUsers();
        return [$arrPosts, $arrUsers];
    }

}