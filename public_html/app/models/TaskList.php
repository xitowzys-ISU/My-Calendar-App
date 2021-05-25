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
            $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function checkTasks()
    {
    }

    /**
     * Getting all the tasks of a individual user
     *
     * @param int $userId
     * @param integer $status
     * @return array
     */
    public function getTasks(int $userId, int $status)
    {
        $result = [];

        $this->changeStatus($userId);

        if (!($status === 4)) {
            $sql = "SELECT * FROM `all_tasks` WHERE `status` LIKE " . $status . " AND `user_id` LIKE " . $userId . " AND `deleted` LIKE 0;";
        } else {
            // ? Здесь должен быть выбор по конкретной дате
            $sql = "SELECT * FROM `all_tasks` WHERE `start_date` LIKE DATE_FORMAT(DATE(NOW()), '%d.%m.%Y' );";
        }


        $query = $this->db->query($sql);
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            array_push($result, $row);
        }

        return $result;
    }

    /**
     * Sets the delete status
     *
     * @param array $data
     * @return void
     */
    public function deleteTask($data)
    {
        $this->db->exec('UPDATE `tasks` SET `deleted` = 1 WHERE `tasks`.`id` LIKE ' . $data['id'] . ';');
    }

    /**
     * Change the status to past due
     *
     * @param integer $userId
     * @return void
     */
    public function changeStatus(int $userId)
    {
        $this->db->exec('UPDATE `tasks` SET `task_status_id` = 2 WHERE `tasks`.`id` IN (SELECT `id` FROM `tasks` WHERE NOT(ADDTIME(`date_and_time`, ADDTIME(`duration`, "00:10:00")) > NOW()) AND `task_status_id` LIKE 1 AND `user_id` LIKE ' . $userId . ');');
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
