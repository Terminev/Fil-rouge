<?php
namespace App\Model;
use Core\Database;

class HomeModel extends Database{
    function home(){
        $_SESSION['connect'] == true;
      return $allSondage = $this->query(" SELECT q.`question`, u.`pseudo`, q.`image`, q.`date_fin` FROM `question` as q INNER JOIN `user` as u on q.`user_id_author` = u.`id` WHERE date_fin >= NOW() ORDER BY date_fin ASC limit 3");
    }
    function homeConnect(){
        //quand l'utilisateur est connecté on récupère ses sondages et on les affiches
        $this->pdo->exec('SET time_zone = "+01:00"');
        $membre_id = $_SESSION['user']['id'];
        $sond = $this->query(" SELECT q.`question_id`, q.`question`, u.`pseudo`, q.`image`, q.`date_fin` FROM `question` as q INNER JOIN `user` as u on q.`user_id_author` = u.`id` WHERE date_fin >= NOW() AND q.`user_id_author` <> ' $membre_id'  ORDER BY date_fin ASC");
        
        $sondPerso = $this->query("SELECT question_id, question, `image`, date_fin FROM question WHERE date_fin >= NOW() and `user_id_author` = '$membre_id' "); 
        
      
        return $requete = array($sond, $sondPerso);
    }

    function statut(){
        //Permets d'attribuer une valeur au statut pour savoir quand l'utilisateur est connecté ou non
        if($_SESSION['connect'])
        {
            $co =$this->pdo->prepare("UPDATE user SET statut= 1 WHERE id =" . $_SESSION['user']['id']);
            $co->execute();
        } //si l'utilisateur appuie sur le bouton déconnexion alors on push un 0 dans la table user statut
        if(isset($_GET['action']) && $_GET['action'] == 'deconnexion'){
            $co =$this->pdo->prepare("UPDATE user SET statut= 0 WHERE id =" . $_SESSION['user']['id']);
            $co->execute();
        }
    }
    
}   