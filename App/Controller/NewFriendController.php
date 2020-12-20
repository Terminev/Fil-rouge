<?php namespace App\Controller;

use App\Model\NewFriendModel;


class NewFriendController {
    public function __construct() {
        $this->model=new NewFriendModel();
    }

    public function render() {
        //si connecté on lui demande une méthode et on require la vue
        if($_SESSION['connect']) {
            $var=$this->model->NewFriend();
            require ROOT."/App/View/newFriendView.php";
            
        }else {//sinon on redirige vers la page d'inscription/connexion
            header('location:index.php?page=sign');
        }
    }
}