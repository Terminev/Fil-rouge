<?php
include '../inc/head.inc.php';
include '../inc/header.inc.php';

//Convertir la date au bon format et nous sert a recuperer le type du mois restant 
function Date_Convert($date)
{
    $jour = substr($date, 8, 2);
    $mois = substr($date, 5, 2);
    $annee = substr($date, 0, 4);
    $heure = substr($date, 11, 2);
    $minute = substr($date, 14, 2);
    $seconde = substr($date, 17, 2);

    $key = array('annee', 'mois', 'jour', 'heure', 'minute', 'seconde');
    $value = array($annee, $mois, $jour, $heure, $minute, $seconde);

    $tab_retour = array_combine($key, $value);

    return $tab_retour;
}

//Mettre un 's' quand c'est au pluriel
function Pluriel($chiffre)
{
    if ($chiffre > 1) {
        return 's';
    };
}

//Calcul du temps restant
function TimeToFin($date)
{
    $tab_date = Date_Convert($date);
    $mkt_jourj = mktime(
        $tab_date['heure'],
        $tab_date['minute'],
        $tab_date['seconde'],
        $tab_date['mois'],
        $tab_date['jour'],
        $tab_date['annee']
    );

    $mkt_now = time();

    $diff = $mkt_jourj - $mkt_now;

    $unjour = 3600 * 24;
    $past = false;
    if ($diff >= $unjour) {
        // EN JOUR
        $past = false;
        $calcul = $diff / $unjour;
        return array(ceil($calcul) . ' jour' . Pluriel($calcul) . '</strong>.', $past);
    } elseif ($diff < $unjour && $diff >= 0 && $diff >= 3600) {
        // EN HEURE
        $past = false;
        $calcul = $diff / 3600;
        return array(ceil($calcul) . ' heure' . Pluriel($calcul) . '</strong>.', $past);
    } elseif ($diff < $unjour && $diff >= 0 && $diff < 3600) {
        // EN MINUTES
        $past = false;
        $calcul = $diff / 60;
        return array(ceil($calcul) . ' minute' . Pluriel($calcul) . '</strong>.', $past);
        '</strong>.';
    } elseif ($diff < 0 && abs($diff) < 3600) {
        // DEPUIS EN MINUTES
        $past = true;
        $calcul = abs($diff / 60);
        return array(ceil($calcul) . ' minute' . Pluriel($calcul) . '</strong>.', $past);
        '</strong>.';
    } elseif ($diff < 0 && abs($diff) <= 3600) {
        // DEPUIS EN HEURES
        $past = true;
        $calcul = abs($diff / 3600);
        return array(ceil($calcul) . 'heure' . Pluriel($calcul) . '</strong>.', $past);
    } else {
        // DEPUIS EN JOUR
        $past = true;
        $calcul = abs($diff) / $unjour;
        return  array(ceil($calcul) . ' jour' . Pluriel($calcul) . '</strong>.', $past);
    };
}
$dateFin = $resultat[0][0]["date_fin"];

list($temps, $past) = TimeToFin($dateFin);
?>
<main>

    <button class="btn btn-info active pop" style="float:right; margin-right:40px">Partager ce sondage</button><br><br>
    <?php
    if ($past == false && $_SESSION['user']['id'] != $sondage[0]->user_id_author && $vote == false) {
    ?>
        <!-- Affichage des choix du sondage si il n'est pas répondu -->
        <section id="sondage">
            <h2><?= $sondage[0]->question ?></h2>
            <br><br>
            <div class="sond">
                <?php foreach ($sondage as $choix) : ?>
                    <button name="addAnswer">
                        <?php $idHash = password_hash($choix->answer_id, PASSWORD_DEFAULT); ?>
                        <a href="index.php?page=sondage&sondage=<?= $choix->question_id ?>&answer=<?= $idHash ?>">
                            <h4><?= $choix->choix ?></h4>
                        </a>
                    </button>
                    <br><br>
                <?php endforeach ?>
            </div>
        </section>

        <!-- Affichage des résultats de ce sondage -->
    <?php } else { ?>
        <section id="sondage">
            <?php
            if ($past) {
                $statut = "Le sondage est terminé depuis " . $temps . "Voici les résultats finaux";
            } else {
                $statut =  "Le sondage se termine dans " . $temps . "Voici les résultats actuels";
            }
            $total = $resultat[1][0]['total'];
            ?>

            <h2>Résultat:</h2>
            <P class="text-center">Statut: <?= $statut ?></P>
            <br><br>
            <h3 class="text-center"><?= $resultat[0][0]["question"] ?></h3>
            <br><br>
            <div class="sond">
                <?php foreach ($resultat[0] as $result) : ?>
                    <h4><?= $result['choix'] ?></h4>
                    <div class="reload">
                        <div class="bar">
                            <?php $nb = round(($result['nombre'] / $total) * 100, 1) ?>
                            <div class="percentage" style="width:<?= $nb ?>%">
                                <p><?= $nb ?>%</p>
                            </div>
                        </div>
                        <p><?= $result['nombre'] ?> votes</p>
                    <?php endforeach; ?>
                    </div>
            </div>
        </section>
    <?php  } ?>

    <br><br><br>

    <!-- Les commentaires du sondage -->
    <section id="commentaire">
        <h2>Commentaire</h2>
        <br><br>
        <div id="com">
            <?php foreach ($commentaire as $com) : ?>
                <div class="msg">
                    <div>
                        <img src="https://www.tbstat.com/wp/uploads/2019/07/20190724_Blockchain-Gaming.jpg">
                        <p><?= $com->pseudo ?></p>
                        <p><?= $com->date ?></p>
                    </div>
                    <div>
                        <p><?= $com->comment ?></p>
                    </div>
                    <br>
                </div>
            <?php endforeach; ?>
            <br>
        </div>



        <!-- Ajouter un commentaire au sondage -->

        <button type="submit" class="btn btn-info combutton active" style="margin:0 auto; display:block">Ajouter un
            commentaire</button>
        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" class="monCom">
            <textarea name="commentaire" id="commentaire" class="form-control" placeholder="Mon commentaire..."></textarea>
            <br>
            <button name="sendcom" id="com2" class="btn btn-info com2 active" type="submit" style="margin:0 auto; display:block">Envoyez</button>
            <br>
        </form>
    </section>

    <!-- Pop up du formulaire pour partager le sondage via les emails -->
    <section class="col-sm-7 mx-auto" id="shareSondage">
        <div class="card position-static">
            <form method="post" enctype="multipart/form-data" id="partage">
                <i class="fas fa-times"></i>
                <div class="card-body">
                    <h2 class="card-title">Partager le sondage : <br><?= $sondage[0]->question ?></h2>
                    <div class="row ">
                        <div class="col-sm-12 mt-4">
                            <label for="nbPerson">Nombre de personne</label>
                            <select id="formNbPerson" type="text" name="nbpersonne" class="form-control" placeholder="Choisissez le nombre de personne à qui partager" required="required" data-error="Le nombre de personne est requis.">
                                <option value="0" selected class="value">Veuillez selectionner un nombre</option>
                                <option value="1" class="value">1</option>
                                <option value="2" class="value">2</option>
                                <option value="3" class="value">3</option>
                                <option value="4" class="value">4</option>
                                <option value="5" class="value">5</option>
                                <option value="6" class="value">6</option>
                            </select>
                        </div>
                        <div id="email">

                        </div>
                        <div class="col-sm-12 mt-4">
                            <label for="message">Message</label>
                            <textarea form="partage" for="textarea" name="textarea" class="form-control">Salut c'est <?= $_SESSION['user']['pseudo'] ?>,<?= "\n" ?>Je te recommande ce sondage de 2Choose dont la question est : <?= $sondage[0]->question ?><?= "\n" ?>Répond y vite et donne moi ton avis ! <?= "\n" ?>Ton ami(e) <?= $_SESSION['user']['pseudo'] ?></textarea>
                        </div>
                        <div class="col-sm-12 mt-4 offset-ms-4">
                            <button type="submit" name="send" class="btn btn-info btn-block active">Envoyez</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
<?php include '../inc/footer.inc.php' ?>