<?php

namespace app\models;

use app\core\Model;
use \PDO;
use \PDOException;

class Editor extends Model
{
    /**
     * Database object
     *
     * @var object PDO
     */
    protected $db;

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Add a task to the database
     *
     * @param integer $userId
     * @param array $data
     * @return void
     */
    public function addTask($userId, array $data)
    {

        $sql = 'INSERT INTO tasks (topic, task_type_id, task_status_id, location, date_and_time, duration, comment, created_at, updated_at, user_id, deleted) 
                VALUES (:topic, :task_type_id, :task_status_id, :location, :date_and_time, :duration, :comment, NOW(), NOW(), :user_id, :deleted)';

        $params = [
            ':topic' => $data['topic'],
            ':task_type_id' => intval($data['type']),
            ':task_status_id' => 1,
            ':location' => $data['place'],
            ':date_and_time' => $data['start_date'] . " " . $data['start_time'],
            ':duration' => $data['duration'],
            ':comment' => $data['comment'],
            ':user_id' => $userId,
            ':deleted' => 0
        ];

        $this->db->prepare($sql)->execute($params);

        echo ("Ok");
    }

    /**
     * Edits a task
     *
     * @param int $userId
     * @param array $data
     * @return void
     */
    public function editTask($userId, array $data)
    {
        extract($data, EXTR_PREFIX_SAME, "extract");

        $sql = <<< SQL
        UPDATE `tasks` SET
        `tasks`.`topic` = '$topic',
        `tasks`.`task_type_id` = $type,
        `tasks`.`location` = '$place',
        `tasks`.`duration` = '$duration',
        `tasks`.`comment` = '$comment',
        `tasks`.`date_and_time` = '$start_date $start_time'
        WHERE `tasks`.`id` LIKE $editTask;
        SQL;

        // debug($sql);
        $this->db->exec($sql);
    }

    /**
     * Get task data by id
     *
     * @param array $data
     * @return array
     */
    public function getTaskDataId(array $data)
    {
        // debug($data);
        $result = [];

        $sql = "SELECT * FROM `all_tasks` WHERE `all_tasks`.`id` LIKE " . $data['id'] . ";";
        $query = $this->db->query($sql);

        $result = $query->fetch(PDO::FETCH_ASSOC);
        $result += ['id' => $data['id']];
        $result += ['DATE' => $result['start_date'] . ' ' . $result['start_time']];
        $result['duration'] = date_format(date_create_from_format('h:m:s', $result['duration']), 'h:m');

        return $result;
    }

    /**
     * Checking for the current record rights
     *
     * @param int $userId
     * @param array $get
     * @return bool
     */
    public function recordOwnership($userId, array $get)
    {
        $sql = "SELECT * FROM `tasks` WHERE `id` LIKE " . $get['id'] . " AND `user_id` LIKE " . $userId . ";";

        $query = $this->db->query($sql);

        if ($query->rowCount() == 1) {
            return true;
        }

        return false;
    }

    /**
     * Error message
     *
     * @param string $errMsg
     * @param array $data
     * @return void
     */
    public function errorMsg($errMsg, $data)
    {
        // $this->data[$data] = $this->model->templateErr('msg-err', $errMsg);
        // return true;
    }
}
