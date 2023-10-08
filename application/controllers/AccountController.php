<?php

namespace App\controllers;

use App\core\Controller;

class AccountController extends Controller
{
    public function loginAction()
    {
        if (!empty($_POST)) {
            $this->view->location('account/login');
        }
        $this->view->render('Вход');
    }

    /**
     * @return void
     */
    public function registerAction()
    {
        $this->view->render('Регистрация');
    }
}