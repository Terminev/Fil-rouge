<?php 
include '../inc/head.inc.php'; 
include '../inc/header.inc.php'; ?>
<main>
    <!-- Affichage des résultats des sondages  -->
    <section id="mesSond">
        <h2>Résultat global</h2>
        <div class="conteneur">
            <?php foreach( $requete[0] as $sondageResult) : ?>
            <div class="boxsondage">
                <a href="index.php?page=sondage&sondage=<?=$sondageResult->question_id?>">
                    <img src="<?= $sondageResult->image ?>" alt="Image de la question <?= $sondageResult->question ?> ">
                    <span>Date de fin : Finit depuis<?= $sondageResult->date_fin ?></span>
                    <p><?= $sondageResult->question ?></p>
                </a>
                <br>
            </div>
            <?php endforeach;?>
        </div>
    </section>

    <!-- Affichage des résultats de mes sondages fini -->
    <section id="mesSond">
        <h2>Les résultat de mes sondages</h2>
        <div class="conteneur">
            <?php foreach( $requete[1] as $sondageResultPerso) : ?>
            <div class="boxsondage">
                <a href="index.php?page=sondage&sondage=<?=$sondageResultPerso->question_id?>">
                    <img src="<?= $sondageResultPerso->image ?>"
                        alt="Image de la question <?= $sondageResultPerso->question ?> ">
                    <span>Date de fin : Finit depuis le <?= $sondageResultPerso->date_fin ?></span>
                    <p><?= $sondageResultPerso->question ?></p>
                </a>
                <br>
            </div>
            <?php endforeach;?>
        </div>
    </section>
</main>
<?php include '../inc/footer.inc.php' ?>