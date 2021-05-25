<?php

namespace app\controllers;

use app\core\Controller;

class TaskListController extends Controller
{
    protected $status;

    protected $data;

    public function indexAction()
    {
        $this->data['{TITLE}'] = 'Мой календарь';

        session_start();

        if(!isset($_SESSION['user'])) {
            header('Location: /auth');
            exit();
        } else {
            $this->data['{SESSION_USER}'] = $_SESSION['user']['login'];
        }


        if (empty($_POST)) {
            $this->status = 1;
            
        } else 
        {
            if(array_key_exists("deleteTask", $_POST))
            {
                // TODO: Сделать проверку на пользователя
                $this->model->deleteTask($_POST['deleteTask']);   
            }
            if(array_key_exists("successTask", $_POST))
            {
                $this->model->setTaskStatus($_POST['successTask'], 3);
            }
            if(array_key_exists("unSuccessTask", $_POST))
            {
                $this->model->setTaskStatus($_POST['unSuccessTask'], 1);
            }
            if(array_key_exists("logout", $_POST))
                $this->model->logout();
            if(array_key_exists("overdueTasks", $_POST))
                $this->status = 2;
            else if (array_key_exists("completedTasks", $_POST))
                $this->status = 3;
            else if (array_key_exists("dateTasks", $_POST))
                $this->status = 4;
            else
                $this->status = 1;
        }

        $this->data['{TASKS_TABLE}'] = $this->generatingForm($this->model->getTasks($_POST, $_SESSION['user']['id'], $this->status));

        $this->view->render($this->data);
    }

    public function generatingForm($tasks) {
        $i = 0;
        $tasksTable = "";

        foreach ($tasks as $key => $value) {
            $tasksTable .= '<tr data-bs-toggle="modal" data-bs-target="#modal' . ++$i . '">';

            foreach ($value as $keys => $values) {
                if ($keys === 'id' || $keys === 'user_id' || $keys === 'created_at' || $keys === 'status' || $keys === 'comment' || $keys === 'deleted')
                    continue;

                $tasksTable .= '<td>' . $values . '</td>';
            }
            $tasksTable .= '</tr>';

            extract($value, EXTR_OVERWRITE, "extract");

            $btnSuccess = "";
            if($value['status'] === '3')
                $btnSuccess = '<form action="/task-list" method="POST"><button type="submit" name="unSuccessTask" value="' . $id . '" class="btn btn-primary">Отметить как текущее</button></form>';
            else
                $btnSuccess = '<form action="/task-list" method="POST"><button type="submit" name="successTask" value="' . $id . '" class="btn btn-success">Отметить как выполненно</button></form>';    
   
            $tasksTable .= <<<XML
            <div class="modal fade" id="modal$i" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">$topic</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Тип: $type</p>
                            <p>Место: $location</p>
                            <p>Дата: $start_date</p>
                            <p>Время: $start_time</p>
                            <p>Длительность: $duration</p>
                            <p>Комментарий: $comment</p>
                        </div>
                        <div class="modal-footer">
                            $btnSuccess
                            <form action="/editor/edit-task" method="GET"><button type="submit" name="id" value="$id" class="btn btn-warning">Изменить</button></form>
                            <form action="/task-list" method="POST"><button type="submit" name="deleteTask" value="$id" class="btn btn-danger">Удалить</button></form>
                        </div>
                    </div>
                </div>
            </div>
            XML;
        }

        return $tasksTable;
    }
}
