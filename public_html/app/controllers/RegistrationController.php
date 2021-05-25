<?php

namespace app\controllers;

use app\core\Controller;

class RegistrationController extends Controller
{

    protected $data;

    public function indexAction()
    {
        $this->data['{TITLE}'] = 'Регистрация';

        if (!empty($_POST)) {

            // TODO: Сделать валидацию данных

            $this->model->register($_POST);
        }

        $this->view->render($this->data);
    }

    /**
     * Input validation
     *
     * @return bool
     */
    public function validation(){

    }
}
