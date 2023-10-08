<?php

namespace App\controllers;

use App\core\Controller;

class MainController extends Controller
{
    public function indexAction() {
        $result = $this->model->genNews();
        $vars = [
                'news' => $result,
        ];

        $this->view->render('Главная страница', $vars);
    }
}