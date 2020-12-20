<?php
namespace App\Controller;

use App\Model\newSondageModel;

class newSondageController{

    public function __construct()
    {
        $this->model = new newSondageModel();
    }

    public function render()
    {
        //si pas connecté alors on redirige vers sign
        if(($_SESSION['connect'] == false )){
            header('location:index.php?page=sign');
        }else{ //sinon si connecté on demande la méthode et on passe une variable plus require la vue
            $msg = $this->model->newsondage();
            require ROOT."/App/View/newSondageView.php";
        }
    }
}
