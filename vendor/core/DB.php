<?php

namespace vendor\core;
/**
 * Клас доступа к базе данных. Паттерн одиночка
 * Class DB
 * @package vendor\core
 */
class DB
{

    private static $instance = null;
    private $host;
    private $db;
    private $user;
    private $pass;
    public $pdo;


    /**
     * В конструкторе устанавливаются все настройки подключения
     * DB constructor.
     */
    private function __construct()
    {
        require_once ROOT . '/configDatabase.php';
        $this->host = $connect['host'];
        $this->db = $connect['db'];
        $this->user = $connect['user'];
        $this->pass = $connect['pass'];
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=utf8";
        $opt = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->pdo = new \PDO($dsn, $this->user, $this->pass, $opt);
    }

    /**
     * Согласно паттерну одиночка, нужно получать только единственный экземляр обьекта.
     * Эта возможность реализована в этом методе
     * @return DB|null
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Метод для получения всех записей с базы данных из двух таблиц. users и posts.
     *
     * @return array
     */
    public function getAllPosts()
    {
        $sql = 'SELECT * FROM users JOIN posts ON users.id = posts.user_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
     * Метод извлечения из таблицы записей одного пользователя.
     * В параметры передается id из таблицы users лимит значений и возвращается массив.
     * @param $user
     * @param $quantity
     * @return array
     */
    public function getOneUsersPosts($user, $quantity)
    {

        $sql = "SELECT users.id as user_id,
                    users.first_name as first_name,
                    users.last_name as last_name,
                    posts.title as title,
                    substring(posts.body, 1, 80) as body
                    FROM users JOIN posts ON users.id = posts.user_id 
                    WHERE users.id = :user LIMIT :quantity";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'user' => $user['user'],
            'quantity' => $quantity
        ]);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function insertData($arr){

        $sql = 'INSERT INTO `posts`(`id`, `user_id`, `title`, `body`) VALUES (:id, :user_id, :title, :body)';

        $stm = $this->pdo->prepare($sql);
        $stm->execute([
            'id' => $arr['id'],
            'user_id' => $arr['userId'],
            'title' => $arr['title'],
            'body' => $arr['body']
        ]);
    }
    public function getUsers(){
        $sql = "SELECT * FROM users";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    private function __clone()
    {
    }
}