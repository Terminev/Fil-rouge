<?php namespace App\Model;
use Core\Database;

class FriendModel extends Database {
    function friend() {
        $msg="";//création du var message
        $idUser=$_SESSION['user']['id']; //stcokage de l'id de l'utilisateur en le récupérant de la session

        //On récupère dans la bdd les informations des amis A et B
        $colA=$this->pdo->query("SELECT u.`pseudo` as pseudo,u.`statut` as statut, f.`user_id_A` as id FROM friend as f INNER JOIN user as u  on f.`user_id_A` = u.`id` WHERE f.`user_id_B` = '$idUser'");
        $colB=$this->pdo->query("SELECT u.`pseudo` as pseudo,u.`statut` as statut, f.`user_id_B` as id FROM friend as f INNER JOIN user as u  on f.`user_id_B` = u.`id` WHERE f.`user_id_A` = '$idUser'");

        if(isset($_POST['button'])) {
            if( !empty($_POST['recherche'])) {
                $recherche=htmlspecialchars(trim($_POST['recherche']));
                $colA=$this->pdo->query("SELECT u.`pseudo` as pseudo, f.`user_id_A` as id FROM friend as f INNER JOIN user as u  on f.`user_id_A` = u.`id` WHERE f.`user_id_B` = '$idUser' AND u.`pseudo` LIKE '$recherche%' ORDER BY id DESC ");
                $colB=$this->pdo->query("SELECT u.`pseudo` as pseudo, f.`user_id_B` as id FROM friend as f INNER JOIN user as u  on f.`user_id_B` = u.`id` WHERE f.`user_id_A` = '$idUser' AND u.`pseudo` LIKE '$recherche%' ORDER BY id DESC ");
            }
        }

        //Permet de récuperer la liste des amis
        if($colA->rowCount()==1 || $colB->rowCount()==1) {
            $colA=$colA->fetchAll(\PDO::FETCH_ASSOC);
            $colB=$colB->fetchAll(\PDO::FETCH_ASSOC);
        }

        else {
            $msg="vous n'avez aucun amis";
        }


        if(isset($_GET['id'])) {
            $idFriend=$_GET['id'];
            $idUser=$_SESSION['user']['id'];
            //verif présence amis dans col A 
            $colA=$this->pdo->query("SELECT user_id_A FROM friend where user_id_A = '$idFriend'  AND user_id_B = '$idUser' ");
            //verif présence amis dans col B 
            $colB=$this->pdo->query("SELECT user_id_B FROM friend where user_id_A = '$idUser'  AND user_id_B = '$idFriend' ");
            //Vérifier si l'amis n'est pas déjà présent dans les amis
            if($colA->rowCount()==1 || $colB->rowCount()==1) {
                $colA=$this->pdo->prepare("DELETE FROM friend where user_id_A = '$idFriend'  AND user_id_B = '$idUser' ");
                $colB=$this->pdo->prepare("DELETE FROM friend where user_id_A = '$idUser'  AND user_id_B = '$idFriend' ");
                $colA->execute();
                $colB->execute();
                header("location:index.php?page=friend");
            }
            //si l'amis est déjà dans la liste d'amis alors on affiche
            else {
                $msg2='vous êtes déjà amis';
            }


        }

        return $var=array($msg, $colA, $colB);

    }
}