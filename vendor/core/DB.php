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
    private $host = 'localhost';
    private $db = 'blog';
    private $user = 'root';
    private $pass = 'root';
    public $pdo;


    /**
     * В конструкторе устанавливаются все настройки подключения
     * DB constructor.
     */
    private function __construct()
    {
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
<<<<<<< HEAD

        $sql = "SELECT users.id,
=======
        $sql = "SELECT users.id as user_id,
>>>>>>> 811aa78 (В класс DB добавил метод который достает посты одного пользователя.)
                    users.first_name as first_name,
                    users.last_name as last_name,
                    posts.title as title,
                    substring(posts.body, 1, 80) as text
                    FROM users JOIN posts ON user_id = posts.user_id 
<<<<<<< HEAD
                    WHERE users.id = :user LIMIT :quantity";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'user' => $user['user'],
=======
                    WHERE user_id = :user LIMIT :quantity";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'user' => $user,
>>>>>>> 811aa78 (В класс DB добавил метод который достает посты одного пользователя.)
            'quantity' => $quantity
        ]);
        $result = $stmt->fetchAll();
        return $result;
    }

    private function __clone()
    {
    }
}