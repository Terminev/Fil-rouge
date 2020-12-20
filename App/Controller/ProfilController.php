<?php
namespace App\Controller;

use App\Model\ProfilModel;

class ProfilController{

    public function __construct()
    {
        $this->model = new ProfilModel();
    }

    public function profil()
    {
        // si connecté on demande la méthode et on passe une variable plus require la vue
        if($_SESSION['connect'] == true){
            $user_infos = $this->model->recup();
            $this->model->profil();
            require ROOT."/App/View/profilView.php";
        }else{//si pas connecté on redirige
         header('location:index.php?page=sign');
        }
    }
}