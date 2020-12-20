<?php
namespace App\Model;
use Core\Database;

class ProfilModel extends Database{ 
    function profil(){
        //Delete toutes les informations d'un USER, le profil, les commentaires, les questions.
        if(isset($_POST['delete'])){
            $iduser = $_SESSION['user']['id'];
            $userD = $this->pdo->prepare("DELETE FROM user WHERE id = '$iduser'");
            $friendD = $this->pdo->prepare("DELETE FROM friend WHERE user_id_A = '$iduser' || user_id_B = '$iduser'");
            $idquestionid = $this->pdo->query("SELECT question_id FROM question WHERE id = '$iduser' ");
            $answerD = $this->pdo->prepare("DELETE FROM answer WHERE id_question_id = '$idquestionid'");
            $questionD = $this->pdo->prepare("DELETE FROM question WHERE user_id_author = '$iduser'");
            $userAD = $this->pdo->prepare("DELETE FROM user_answer WHERE user_id = '$iduser'");
            $userCD = $this->pdo->prepare("DELETE FROM user_comment WHERE user_id = '$iduser'");
            
            $userD->execute();
            $friendD->execute();
            $questionD->execute();
            $answerD->execute();
            $userAD->execute();
            $userCD->execute();
            session_destroy();
            header("location:index.php?page=home");
        }
        
    }
    function recup(){ 
        //recuperer des information afin de les utiliser dans la view
    $id = $_SESSION['user']['id'];
    $user =  $this->query("SELECT * FROM `user` WHERE id = '$id'");
    $friend =  $this->query("SELECT count(friend_id) as nb_ami from friend where user_id_A ='$id' OR user_id_B = '$id'");
    $sondage = $this->query("SELECT count(question_id) as nb_sond from question where user_id_author = '$id'");
    return array($user,$friend,$sondage);
    }
}