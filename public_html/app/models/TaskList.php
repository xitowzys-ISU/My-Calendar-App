<?php

namespace app\models;

use app\core\Model;
use \PDO;
use \PDOException;

class TaskList extends Model
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
            $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Getting all the tasks of a individual user
     *
     * @param int $userId
     * @param integer $status
     * @return array
     */
    public function getTasks(array $data, int $userId, int $status)
    {
        $result = [];

        $this->checkingForDelinquency($userId);

        if (!($status === 4)) {
            $sql = "SELECT * FROM `all_tasks` WHERE `status` LIKE " . $status . " AND `user_id` LIKE " . $userId . " AND `deleted` LIKE 0;";
        } else {
            $sql = "SELECT * FROM `all_tasks` WHERE `start_date` LIKE '" . $data['date'] . "' AND `user_id` LIKE " . $userId . ";";
            
        }


        $query = $this->db->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            array_push($result, $row);
        }

        return $result;
    }

    /**
     * Set the task status
     *
     * @param int $id
     * @param int $idStatus
     * @return void
     */
    public function setTaskStatus(int $id, int $idStatus)
    {
        $this->db->exec('UPDATE `tasks` SET `task_status_id` = ' . $idStatus .' WHERE `tasks`.`id` LIKE ' . $id . ';');
    }

    /**
     * Sets the delete status
     *
     * @param int $id
     * @return void
     */
    public function deleteTask(int $id)
    {
        $this->db->exec('UPDATE `tasks` SET `deleted` = 1 WHERE `tasks`.`id` LIKE ' . $id . ';');
    }

    /**
     * Change the status to past due if the task date has expired
     *
     * @param integer $userId
     * @return void
     */
    public function checkingForDelinquency(int $userId)
    {
        //debug('UPDATE `tasks` SET `task_status_id` = 2 WHERE `tasks`.`id` IN (SELECT `id` FROM `tasks` WHERE NOT(ADDTIME(`date_and_time`, ADDTIME(`duration`, "00:10:00")) > NOW()) AND `task_status_id` LIKE 1 AND `user_id` LIKE ' . $userId . ');');
        //$this->db->exec('UPDATE `tasks` SET `task_status_id` = 2 WHERE `tasks`.`id` IN (SELECT `id` FROM `tasks` WHERE NOT(ADDTIME(`date_and_time`, ADDTIME(`duration`, "00:10:00")) > NOW()) AND `task_status_id` LIKE 1 AND `user_id` LIKE ' . $userId . ');');
        $this->db->exec('UPDATE `tasks` SET `task_status_id` = 2 WHERE `tasks`.`id` IN (SELECT * FROM ((SELECT `id` FROM `tasks` WHERE NOT(ADDTIME(`date_and_time`, ADDTIME(`duration`, "00:10:00")) > NOW()) AND `task_status_id` LIKE 1 AND `user_id` LIKE ' . $userId . ')) AS t1)');
    }

    public function checkStatus($int) {

    }

    /**
     * Log out of your account
     *
     * @return void
     */
    public function logout()
    {
        session_destroy();
        header("Location: /auth");
    }
}
