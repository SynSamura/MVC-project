<?php

namespace application\core;

use application\core\View;

class Controller
{

    public $route;
    public $view;
    public $acl;

    public function __construct($route)
    {
        $this->route = $route;
        if (!$this->checkAcl()){
            View::errorCode(403);
        }
        $this->view = new View($route);
        $this->model = $this->LoadModel($route['controllers']);
    }

    /**
     * Подключение Моделей
     *
     * @param $name
     * @return mixed|void

     */
    public function LoadModel($name)
    {
        $pach = 'application\models\\' . ucfirst($name);
        if (class_exists($pach)) {
            return new $pach;
        }
    }

    /**
     * Контроль доступа
     *
     * @return bool
     */
    public function checkAcl() {
        $this->acl = require 'application/acl/'.$this->route['controllers'].'.php';
        if ($this->isAcl('all')) {
            return true;
        }
        elseif (isset($_SESSION['authorize']['id']) and $this->isAcl('authorize')) {
            return true;
        }
        elseif (!isset($_SESSION['authorize']['id']) and $this->isAcl('guest')) {
            return true;
        }
        elseif (isset($_SESSION['admin']) and $this->isAcl('admin')) {
            return true;
        }
        return false;
    }
    public function isAcl($key) {
        return in_array($this->route['action'], $this->acl[$key]);

    }
}