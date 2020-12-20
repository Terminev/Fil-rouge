<?php
namespace App\Controller;

use App\Model\ProfilModifModel;

class ProfilmodifController{

    public function __construct()
    {
        $this->model = new ProfilModifModel();
    }

    public function modifier()
    {
        //sinon si connecté on demande la méthode et on passe une variable plus require la vue
        if($_SESSION['connect'] == true){  
            
            $message =  $this->model->modifier();
            $user_infos = $this->model->recup();
            require ROOT."/App/View/profilModifView.php";
        }else{//si pas connecté on redirige
         header('location:index.php?page=sign');
        }
    }
}