<?php
namespace App\Controller;

use App\Model\SignModel;

class SignController{

    public function __construct()
    {
        $this->model = new SignModel();
    }

    public function render()
    {
        //si pas connecté on demande la méthode et on passe une variable plus require la vue
        if(($_SESSION['connect'] == false )){
            $msg =  $this->model->inscription();
            $msgCo = $this->model->connexion();
            require ROOT."/App/View/signView.php";
        }else{//sinon si connecté on redirige vers la page profil
         header('location:index.php?page=profil');
        }
    }
}
