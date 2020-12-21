<?php
include '../inc/head.inc.php';
include '../inc/header.inc.php';
?>
<main>
    <!-- Formulaire de création d'un nouveau sondage -->
    <section class="col-sm-7 mx-auto" id="newSondage">
        <div class="card position-static">
            <form class="card-body" method="post">
                <h2 class="card-title">Créer un sondage</h2>
                <div class="  col-sm-12 mt-3">
                    <label for="question">Question</label>
                    <input type="text" name="question" class="form-control" placeholder="Entrez votre question" required="required" data-error="La question est requise.">
                </div>
                <div class="  col-sm-12 mt-3">
                    <label for="image">Lien de l'image</label>
                    <input type="text" name="image" class="form-control" placeholder="Entrez le lien de votre image" required="required" data-error="L'image est requise.">
                </div>
                <!-- Choix des nombres des réponses proposées dans le sondage  -->
                <div class="  col-sm-12 mt-3">
                    <label for="reponseNb ">Nombre de réponse</label>
                    <select id="reponseNb" type="text" name="nbquestion" class="form-control" placeholder="Nombre de vos proposition de réponse" required="required" data-error="Le nombre de réponse est requis.">
                        <option value="" selected class="value">Selectionnez un nombre</option>
                        <option value="2" class="value">2</option>
                        <option value="3" class="value">3</option>
                        <option value="4" class="value">4</option>
                        <option value="5" class="value">5</option>
                        <option value="6" class="value">6</option>
                        <option value="7" class="value">7</option>
                        <option value="8" class="value">8</option>
                        <option value="9" class="value">9</option>
                        <option value="10" class="value">10</option>
                    </select>
                </div>
                <!-- Apparition des champs pour remplir les propositions de réponses lors du choix du nombre de celles-ci (voir main.js) -->
                <div id="proposition" required="required">
                </div>
                <div class="col-sm-12 mt-3">
                    <label for="date">Date d'expiration</label>
                    <input type="datetime-local" name="date" class="form-control" placeholder="Choisissez la date d'expiration" required="required" data-error="La date d'expiration est requise.">
                </div>
                <div class="  col-sm-12 mt-4 offset-ms-4">
                    <button name="boutton" id="boutonPropo" type="submit" class="btn btn-info btn-block active">Envoyez</button>
                </div>
            </form>
        </div>
        <?php echo $msg; ?>
    </section>
</main>
<?php include '../inc/footer.inc.php' ?>