<?php

namespace app\controllers;

use app\core\Controller;
use app\core\View;

class EditorController extends Controller
{
    protected $data;

    public function addTaskAction()
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: /auth');
            exit();
        }

        $this->data['{TITLE}'] = 'Добавить запись';

        if (!empty($_POST) && (!array_key_exists("addTask", $_POST)  || !array_key_exists("editTask", $_POST))) {

            if (!$this->dataValidation()) {
                $this->model->addTask($_SESSION['user']['id'], $this->dataFormatting($_POST));
            }
        }

        $this->view->render($this->data);
    }

    public function editTaskAction()
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: /auth');
            exit();
        }

        $view = new View();

        if (!empty($_POST)) {

            if (!$this->dataValidation()) {
                $this->model->editTask($_SESSION['user']['id'], $this->dataFormatting($_POST));
                header('Location: /');
            }
        }

        if (!array_key_exists("id", $_GET) && empty($_POST)) {
            $view->errorCode(404);
            exit();
        } else {
            if (!$this->model->recordOwnership($_SESSION['user']['id'], $_GET)) {
                $view->errorCode(403);
                exit();
            } else {

                foreach ($this->model->getTaskDataId($_GET) as $key => $value) {

                    if ($key === 'type') {
                        $this->data['{SELECT_' . strtoupper($key) . '[' . $value . ']}'] = "selected";
                    }

                    $this->data['{' . strtoupper($key) . '}'] = htmlspecialchars($value);
                }
            }
        }

        $this->data['{TITLE}'] = 'Изменить запись';

        $this->view->render($this->data);
    }

    /**
     * Formatting the date and time to a database format
     *
     * @param array $data
     * @return array
     */
    protected function dataFormatting($data)
    {

        $datetime = explode(" ", $data['datetime']);

        $data += ['start_date' => date_format(date_create_from_format('d.m.Y', $datetime[0]), 'Y-m-d')];
        $data += ['start_time' => date_format(date_create_from_format('H:m', $datetime[1]), 'H:m:s')];

        $data['duration'] = date_format(date_create_from_format('H:m', $data['duration']), 'H:m:s');

        return $data;
    }

    /**
     * Field validation
     *
     * @return bool
     */
    protected function dataValidation()
    {
        $isErr = false;

        if (empty($_POST['topic'])) {
            $isErr = $this->errorMsg("Вы не ввели тему", "{ERROR_FIRST_NAME}");
        }

        return $isErr;
    }

    protected function errorMsg($errMsg, $data)
    {
        // $this->data[$data] = $this->model->templateErr('msg-err', $errMsg);
        return true;
    }
}
