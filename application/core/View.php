<?php

namespace App\core;

class View
{

    public $path;
    public $route;
    public $layout = 'default';


    /**
     * Конструкт это магический метод
     *
     *
     * @param $route
     */
    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controllers'] . '/' . $route['action'];
    }

    public function render($title, $vars = [])
    {
        extract($vars);
        $path = 'application/views/' . $this->path . '.php';
        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require 'application/views/layout/' . $this->layout . '.php';
        }
    }

    public function redirect($url)
    {
        header('location: ' . $url);
        exit;
    }

    public static function errorCode($code)
    {
        http_response_code($code);
        $path = 'application/views/errors/' . $code . '.php';
        if (file_exists($path)) {
            require $path;
        }
        exit;
    }

    /**
     * Вывод сообщения JS
     *
     * @param $status
     * @param $message
     * @return void
     */
    public function message($status, $message) {
        exit(json_encode(['status' => $status, 'message' => $message]));

    }

    /**
     * Редирект для JS
     * JS не видно
     * @param $url
     * @return void
     *
     */
    public function location($url)
    {
        exit(json_encode(['url' => $url]));
    }
    }