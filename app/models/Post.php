<?php
namespace app\models;

use vendor\core\DB;

class Post
{
    public $table_name = 'Posts';
    public $quantity = 5;

    /**
     * Метод модели который выводит посты всех пользователей
     * @return array
     */
    public function getAll()
    {
       return DB::getInstance()->getAllPosts();
    }

    /**
     * Метод фильтрует посты по одному пользователю
     * @param $user
     * @return array
     */
    public function getOneUserPosts($user){

        return DB::getInstance()->getOneUsersPosts($user, $this->quantity);

    }
}