<?php

namespace app\models;

use app\core\Model;
use \PDO;
use \PDOException;

class TaskList extends Model
{
    public function getTasks(int $status)
    {
        $result = [];

        try {
            $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        if (!($status === 4)) {
            $sql = "SELECT * FROM `all_tasks` WHERE `status` LIKE " . $status . ";";
        } else {
            $sql = "SELECT * FROM `all_tasks` WHERE `start_date` LIKE DATE_FORMAT(DATE(NOW()), '%d.%m.%Y' );";
        }

        $query = $db->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            array_push($result, $row);
        }

        return $result;
    }
}
