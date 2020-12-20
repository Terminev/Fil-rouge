<?php namespace App\Controller;

use App\Model\SondageModel;

class SondageController {

    public function __construct() {
        $this->model=new SondageModel();

    }

    public function render() {
        //si connecté on demande les méthodes et on passe des variables
        if(($_SESSION['connect'])) {
            $id=$this->model->verif();
            $msg =$this->model->share();
            //si la requete sql stocker dans id n'est pas vide et si l'url possède une variable sondage pas vide alors on demande 
            //des méthodes puis on require la bu
            if( !empty($id) && !empty($_GET['sondage'])) {
                $sondage=$this->model->sondage();
                $resultat = $this->model->result();
                $commentaire = $this->model->comment();
                // $com = $this->model->saveCom();
                // $data = $this->model->getCom();
               $vote = $this->model->addAnswer();
                require ROOT."/App/View/sondageView.php";
            }else { //sinon id est vide ou le $_get sondage est vide alors on redirige vers l'acceuil
                header('location:index.php?page=home');
            }
        }else{//si pas connecté on redirige
            header('location:index.php?page=home');
        }
    }
}