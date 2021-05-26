<?php

namespace app\models;

use app\core\Model;
use \PDO;
use \PDOException;

class Auth extends Model
{
    /**
     * Check for registration
     *
     * @param array $data
     * @return bool
     */

    protected $db;

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return bool
     */
    public function checkUser(array $data)
    {
        $sql = "SELECT * FROM `users` WHERE `login` LIKE '" . $data['login'] . "';";

        $query = $this->db->query($sql);

        if ($query->rowCount() == 1) {
            if(password_verify($data['password'], $query->fetch(PDO::FETCH_ASSOC)['password']))
                return true;
        }

        return false;
    }

    /**
     * Account Authorization
     *
     * @param array $data
     * @return void
     */
    public function authorization(array $data)
    {
        session_start();

        $sql = "SELECT * FROM `users` WHERE `login` LIKE '" . $data['login'] . "';";

        $query = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);


        $_SESSION['user'] = [
            'id' => $query['id'],
            'login' => $query['login'],
            'email' => $query['email']
        ];

        header('Location: /task-list');
        exit();
    }
}
