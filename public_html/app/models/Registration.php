<?php

namespace app\models;

use app\core\Model;
use \PDO;
use \PDOException;

class Registration extends Model
{
    /**
     * User Registration
     *
     * @param array $data
     * @return void
     */
    public function register(array $data) {
        try {
            $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME , DB_USER, DB_PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }    
        catch(PDOException $e) {
            echo $e->getMessage();
        }

        $sql = 'INSERT INTO users (login, email, password) 
        VALUES (:login, :email, :password)';

        $params = [
            ':login' => $data['login'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT)
        ];

        $db->prepare($sql)->execute($params);

        // TODO: Сделать нормальный выход
        echo("Ok");
    }
}