<header>
    <div style="width:100px">

    </div>
    <div>
        <a href="../public/index.php?page=home">
        <img src="..\Public\Asset\img\logo.png">
        </a>
        </div>
    <div>
        
    <a 
    <?php 
    if(!isset($_SESSION['connect'])){
        $_SESSION['connect'] = false;
    }
    if($_SESSION['connect'] == true) { 
        ?>  href="../public/index.php?page=profil" 
            <?php }else{ ?> href="../public/index.php?page=sign" <?php   } ?> ><i class="fas fa-user"></i></a>
        <i class="fas fa-bars"></i>

    </div>
    <?php
   
   
        if(isset($_GET['action']) && $_GET['action'] == 'deconnexion') {
        session_destroy();
        header('location:index.php?page=home');
    }
    ?>

    <nav>
   
        <div><i class="fas fa-times"></i></div>
        <a href="../public/index.php?page=home">Accueil</a>
        <hr>
        <a href="../public/index.php?page=newSondage">Nouveau sondage</a>
        <hr>
        <a href="../public/index.php?page=resultats">Résultat</a>
        <hr>
        <a href="../public/index.php?page=friend">Amis</a>
        <?php if($_SESSION['connect'] == true) { ?>
        <hr>
        <a href="index.php?page=home&action=deconnexion">Deconnexion</a>
        <?php } ?>
    </nav>
</header>