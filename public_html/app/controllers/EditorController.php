<?php

namespace app\controllers;

use app\core\Controller;

class EditorController extends Controller
{

    private $data;

    public function indexAction()
    {
        $this->data['{TITLE}'] = 'Редактор';

        if (!empty($_POST)) {

            if(!$this->dataValidation()) {
                
                $this->model->addTask($this->dataFormatting($_POST));
            }
        }

        $this->view->render($this->data);
    }


    public function dataFormatting($data) {
        
        $datetime = explode(" ", $data['datetime']);

        $data += ['start_date' => date_format(date_create_from_format('d.m.Y', $datetime[0]),'Y-m-d')];
        $data += ['start_time' => date_format(date_create_from_format('h:m', $datetime[1]),'h:m:s')];
        
        $data['duration'] = date_format(date_create_from_format('h:m', $data['duration']),'h:m:s');

        return $data;
    }

    public function dataValidation() {
        $isErr = false;

        if (empty($_POST['topic'])) {
            $isErr = $this->errorMsg("Вы не ввели тему", "{ERROR_FIRST_NAME}");
        }

        return $isErr;
    }

    protected function errorMsg($errMsg, $data) {
        // $this->data[$data] = $this->model->templateErr('msg-err', $errMsg);
        return true;
    }
}