<?php

namespace app\models;

use app\core\Model;
use \PDO;
use \PDOException;

class Editor extends Model
{
    public function addTask($data) {
        try {
            $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME , DB_USER, DB_PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }    
        catch(PDOException $e) {
            echo $e->getMessage();
        }

        $sql = 'INSERT INTO tasks (topic, task_type_id, task_status_id, location, date_and_time, duration, comment, created_at, updated_at, user_id) 
                VALUES (:topic, :task_type_id, :task_status_id, :location, :date_and_time, :duration, :comment, NOW(), NOW(), :user_id)';
        
        $params = [
            ':topic' => $data['topic'],
            ':task_type_id' => intval($data['type']),
            ':task_status_id' => 1,
            ':location' => $data['place'],
            ':date_and_time' => $data['start_date'] . " " . $data['start_time'],
            ':duration' => $data['duration'],
            ':comment' => $data['comment'],
            ':user_id' => 1
        ];
        
        $db->prepare($sql)->execute($params);
        
        echo("Ok");
    }
}