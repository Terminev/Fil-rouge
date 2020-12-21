<?php namespace App\Model;
use Core\Database;

class ClassementModel extends Database {
    //permet de récuperer les troix premier pseudo qui ont le plus de point
    function Classement(){
        return $top = $this->query("SELECT pseudo FROM `user` ORDER BY `point` DESC LIMIT 3");
    }
    //permet de récuperer les id des amis qui sont présent soit dans la colonne A ou de la colonne B de la BDD
    function friendClassement() {
       $id = $_SESSION['user']['id'];
        $idfriendA = $this->query("SELECT u.`pseudo` as pseudo,u.`point` as point, f.`user_id_A` as id FROM friend as f INNER JOIN user as u  on f.`user_id_A` = u.`id` WHERE f.`user_id_B` = '$id' ORDER BY `point` DESC");
        $idfriendB = $this->query("SELECT u.`pseudo` as pseudo,u.`point` as point, f.`user_id_B` as id FROM friend as f INNER JOIN user as u  on f.`user_id_B` = u.`id` WHERE f.`user_id_A` = '$id' ORDER BY `point` DESC ");
        return array($idfriendA, $idfriendB);
    }
}
