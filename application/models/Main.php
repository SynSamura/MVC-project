<?php

namespace App\models;



use App\core\Model;

class Main extends Model {

    public function genNews(){
        $result = $this->db->row('SELECT title, description FROM news');
        return $result;
    }
}