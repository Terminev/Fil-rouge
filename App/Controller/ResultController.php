<?php
namespace App\Controller;

use App\Model\ResultModel;

class ResultController{

    public function __construct()
    {
        $this->model = new ResultModel();
    }

    public function render()
    {
        //sinon si connecté on demande la méthode et on passe une variable plus require la vue
        if($_SESSION['connect']){
            $requete =  $this->model->resultat();
            require ROOT."/App/View/resultView.php";
        }else{//si pas connecté on redirige
            header('location:index.php?page=sign');
        } 
    }
}
