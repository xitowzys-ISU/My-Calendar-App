<?php

namespace app\controllers;

use app\core\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        $routes = require 'app/config/routes.php';
        $newUrl = 'task-list';

        if (array_key_exists($newUrl, $routes)) {
            header('Location: /' . $newUrl);
            exit();
        } else {
            echo 'Route ' . $newUrl . ' is not found';
        }

        debug($this->route);
    }
}
