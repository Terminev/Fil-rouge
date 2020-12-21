<?php

namespace App\Controller;

use App\Model\ClassementModel;


class ClassementController
{
    public function __construct()
    {
        $this->model = new ClassementModel();
    }
    public function render()
    {      
        $top = $this->model->Classement();
        $myfriend = $this->model->friendClassement();
        //on require la vue    
        require ROOT . "/App/View/classementView.php";
    }
}
