<?php namespace App\Controller;
/**
 * information du repertoire friendModel
 */
use App\Model\FriendModel;

/**
 * creation class 
 */
class FriendController {
    /**
     * instantion de la classe apellé
     */
    public function __construct() {
        $this->model=new FriendModel();
    }
/**
 * function du rendu de la vue
 *
 * @return void
 */
    public function render() {
        // si connecté alors on lui utilise la méthode friends dans la classe friendModel en lui donnant la variable var 
        //ainsi que la vue de friend
        if($_SESSION['connect']) { 
            $var=$this->model->friend();
            // $co = $this->model->statut();
            require ROOT."/App/View/friendView.php";
            //sinon on redirige vers la page sign
        }else {
            header('location:index.php?page=sign');
        }
    }

}