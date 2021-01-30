<?php
namespace app\models;

use vendor\core\DB;

class Post
{
    public $table_name = 'Posts';

    public function getAll()
    {
       return DB::getInstance()->getAllPosts();
    }
}