<?php namespace App\Model;
use Core\Database;

class ProfilModifModel extends Database {
    function recup() {
        $id = $_SESSION['user']['id'];
        $user =  $this->query("SELECT * FROM `user` WHERE id = '$id'");
        $friend =  $this->query("SELECT count(friend_id) as nb_ami from friend where user_id_A ='$id' OR user_id_B = '$id'");
        $sondage = $this->query("SELECT count(question_id) as nb_sond from question where user_id_author = '$id'");
        $nbrpoint = $this->query("SELECT point FROM user WHERE id = '$id'");
        return array($user,$friend,$nbrpoint);
    }

    function modifier() {
        $error=false;
        $msg="modification faites";
        $id=$_SESSION['user']['id']; //récup id 

        if(isset($_POST['bouton'])) {
            //on vérifie si les champs ne sont pas vides.
            if(!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['mdp'])) {
                $mdp=trim($_POST['mdp']);
                $recup_infos=$this->pdo->query("SELECT * FROM user WHERE id = '$id' ");
                $infos_membre=$recup_infos->fetch(\PDO::FETCH_ASSOC);
                //verification du mots de passe
                if(password_verify($mdp, $infos_membre['mdp'])==true) {
                    $Nmdp="";
                    //si le nouveau mot de passe n'est pas vide alors il est hash et exporté vers la BDD
                    if( !empty($_POST['Nmdp'])) {
                        $Nmdp=trim($_POST['Nmdp']);
                        var_dump($Nmdp);
                        $Nmdp=password_hash($Nmdp, PASSWORD_DEFAULT);
                    }
                    //Si le champ est vide alors le mot de passe est de nouveau push dans la BDD
                    else {
                        $Nmdp=$mdp;
                        var_dump($Nmdp);
                        $Nmdp=password_hash($Nmdp, PASSWORD_DEFAULT);
                    }
                    //Supprime les espaces en début et en fin de chaine de caractère ainsi que les balises HTML
                    $prenom=htmlspecialchars(trim($_POST['prenom']));
                    $nom=htmlspecialchars(trim($_POST['nom']));
                    $pseudo=htmlspecialchars(trim($_POST['pseudo']));
                    $email=htmlspecialchars(trim($_POST['email']));

                    //update de la BDD
                    $enregistrement=$this->pdo->prepare("UPDATE user SET nom = :nom , prenom = :prenom, pseudo = :pseudo, email = :email, mdp = :Nmdp WHERE id = '$id' ");

                    $enregistrement->bindParam(':nom', $nom, \PDO::PARAM_STR);
                    $enregistrement->bindParam(':prenom', $prenom, \PDO::PARAM_STR);
                    $enregistrement->bindParam(':pseudo', $pseudo, \PDO::PARAM_STR);
                    $enregistrement->bindParam(':email', $email, \PDO::PARAM_STR);
                    $enregistrement->bindParam(':Nmdp', $Nmdp, \PDO::PARAM_STR);
                    $enregistrement->execute();

                    //rediriger
                    header("location:index.php?page=profil");
                }

                else {
                    $error=true;
                    $msg="<div style='margin: 10px auto; padding:10px 0; width: 90%; background-color: red; text-transform: uppercase; color: white; text-align: center;'>Mdp incorrect</div>";
                }

            }

            else {
                $error=true;
                $msg="<div style='margin: 10px auto; padding:10px 0; width: 90%; background-color: red; text-transform: uppercase; color: white; text-align: center;'>Veuiller remplir tous les champs</div>";
            }
        }

        return $message=array($error, $msg);
    }
}

?>