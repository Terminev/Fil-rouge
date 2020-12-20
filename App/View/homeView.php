<?php 
include '../inc/head.inc.php'; 
include '../inc/header.inc.php'; ?>
<main id="accueil">
    <!-- Les sondages en cours (en dehors du membre) -->
    <section>
        <h2>Sondages en cours</h2>
        <div class="conteneur">
            <!-- Si l'internaute n'est pas connecté, seulement 3 sondages sont montrés, il faut qu'il se connect pour y avoir accès et en voir plus
            Si l'internaute est connecté, il voit tous les sondages et peut y répondre -->
            <?php 
            if($_SESSION['connect']){
                $sond =  $requete[0] ;
            }else{
                $sond = $allSondage;
            }
            foreach($sond as $sondage) :
           ?>
           <!-- Affichage des sondages -->
            <div class="boxsondage">
                <a href="index.php?page=sondage&sondage=<?=$sondage->question_id?>">
                    <img src="<?= $sondage->image ?>" alt="Image de la question ' + <?= $sondage->question ?> + '">
                    <span>Posté par : <?= $sondage->pseudo ?> <br> Date de fin : <?= $sondage->date_fin ?></span>
                    <p><?= $sondage->question ?></p>
                </a>
                <br>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- Affichage des boutons lorsque l'internaute n'est pas connecté -->
        <?php if($_SESSION['connect'] == false): ?>
        <button
            onclick="alert('Pour pouvoir voir tous les sondages, veuillez-vous connecter'), window.location.href='index.php?page=sign'"
            class="btn btn-info active" style="margin:0 auto; display:block">Voir d'autres sondages</button>
        <br><br><br><br>
        <h2>Mes sondages</h2>
        <br><br>
        <button
            onclick="alert('Pour pouvoir voir vos sondages, veuillez-vous connecter'), window.location.href='index.php?page=sign'"
            class="btn btn-info active" style="margin:0 auto; display:block">Voir mes sondages</button>
        <?php endif; ?>
    </section>

    <!-- Affichage des sondages du membre lorsqu'il est connecté -->
    <?php if($_SESSION['connect']): ?>
    <section id="mesSond">
        <h2>Mes sondages</h2>
        <div class="conteneur">
            <?php foreach( $requete[1] as $sondagePerso) : ?>
            <div class="boxsondage">
                <a href="index.php?page=sondage&sondage=<?= $sondagePerso->question_id?>">
                    <img src="<?= $sondagePerso->image ?>"
                        alt="Image de la question ' + <?= $sondagePerso->question ?> + '">
                    <span>Date de fin : <?= $sondagePerso->date_fin ?></span>
                    <p><?= $sondagePerso->question ?></p>
                </a>
                <br>
            </div>
            <?php endforeach;?>
        </div>
    </section>
    <?php endif; ?>
</main>

<?php include '../inc/footer.inc.php'; ?>