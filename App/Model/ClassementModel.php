<?php namespace App\Model;
use Core\Database;

class ClassementModel extends Database {
    function Classement(){
        return $top = $this->query("SELECT pseudo FROM `user` ORDER BY `point` DESC LIMIT 3");
    }
}
