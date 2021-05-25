<?php

namespace app\controllers;

use app\core\Controller;

class AuthController extends Controller
{

    protected $data;

    public function indexAction()
    {
        $this->data['{TITLE}'] = 'Авторизация';


        if (!empty($_POST)) {

            if($this->model->checkUser($_POST))
                $this->model->authorization($_POST);
            else
                debug("Неверный логин или пароль");
        }
        

        $this->view->render($this->data);
    }
}
