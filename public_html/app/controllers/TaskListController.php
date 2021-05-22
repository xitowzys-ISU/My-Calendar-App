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

        if (empty($_POST)) {
            $this->status = 1;
            
        } else 
        {
            if(array_key_exists("overdueTasks", $_POST))
                $this->status = 2;
            else if (array_key_exists("completedTasks", $_POST))
                $this->status = 3;
            else if (array_key_exists("tasksForToday", $_POST))
                $this->status = 4;
            else
                $this->status = 1;
            // debug($_POST);
        }

        $tasks = $this->model->getTasks($this->status);

        $tasksTableShort = "";

        $i = 0;
        foreach ($tasks as $key => $value) {
            $tasksTableShort .= '<tr data-bs-toggle="modal" data-bs-target="#modal' . ++$i . '">';

            foreach ($value as $keys => $values) {
                if ($keys === 'id' || $keys === 'user_id' || $keys === 'created_at' || $keys === 'status' || $keys === 'comment')
                    continue;

                $tasksTableShort .= '<td>' . $values . '</td>';
            }
            $tasksTableShort .= '</tr>';

            $topic = $value['topic'];
            $type = $value['type'];
            $location = $value['location'];
            $start_date = $value['start_date'];
            $start_time = $value['start_time'];
            $duration = $value['duration'];
            $comment = $value['comment'];

            $tasksTableShort .= <<<XML
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
                            <button type="button" class="btn btn-warning">Изменить</button>
                            <button type="button" class="btn btn-danger">Удалить</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>
            XML;
        }

        $this->data['{TASKS_TABLE_SHORT}'] = $tasksTableShort;

        $this->view->render($this->data);
    }
}
