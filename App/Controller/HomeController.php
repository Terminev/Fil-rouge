<?php
namespace App\Controller;

use App\Model\HomeModel;


class HomeController{
    public function __construct()
    {
        $this->model = new HomeModel();
    }
    public function render()
    {    //si la variable connect n'existe pas dans le $_Session on lui donne la valeur false
        if(!isset($_SESSION['connect'])){
            $_SESSION['connect'] = false;
        }
        //s'il est connecté on lui demande les methodes 
        if($_SESSION['connect'] == true){
            $requete = $this->model->homeConnect();
           $this->model->statut(); 
        }else{
            //sinon on lui demande une autre métho
            $allSondage = $this->model->home();
        }     
        //on require la vue    
        require ROOT."/App/View/homeView.php";
    }
}