<?php namespace App\Model;
use Core\Database;

class ClassementModel extends Database {
    function Classement(){
        return $top = $this->query("SELECT pseudo FROM `user` ORDER BY `point` DESC LIMIT 3");
    }
    function friendClassement() {
       $id = $_SESSION['user']['id'];
       $myidFriendA = $this->prepare("SELECT `user_id_A` FROM `friend` WHERE `user_id_B` = '$id'");
       $myidFriendB = $this->prepare("SELECT `user_id_B` FROM `friend` WHERE `user_id_A` = '$id'");
       return $infosUser = $this->pdo->prepare("SELECT pseudo, `point` FROM `user` WHERE id = '$myidFriendA' OR id = '$myidFriendB' ORDER BY `point` DESC");
    }
}
