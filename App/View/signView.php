<?php 
include '../inc/head.inc.php'; 
include '../inc/header.inc.php';
?>

<main id="signMain">
    <div class="row">
        <div class="col-sm-1">
        </div>
        <!-- Formulaire d'inscription -->
        <section class="col-sm-5 position-static" id="inscription">
            <div class="card ">
                <div class="card-body">
                    <h2 class="card-title">Inscription</h2>
                    <form class="row " method="post">
                        <div class="col-sm-6">
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" class="form-control" placeholder="Entrez votre nom"
                                required="required" data-error="Le nom est requis.">
                        </div>
                        <div class="col-sm-6 position-static">
                            <label for="prenom ">Prénom</label>
                            <input type="text" name="prenom" class="form-control" placeholder="Entrez votre prénom"
                                required="required" data-error="Le prénom est requis.">
                        </div>
                        <div class="col-sm-12 mt-4 position-static">
                            <label for="pseudo">Pseudo</label>
                            <input type="text" name="pseudo" class="form-control" placeholder="Choisissez un pseudo"
                                required="required" data-error="Le pseudo est requis.">
                        </div>
                        <div class="col-sm-12 mt-4 position-static">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Entrez votre email"
                                required="required" data-error="Le mail est requis.">
                        </div>
                        <div class="col-sm-12 mt-4 position-static">
                            <label for="mdp">Password</label>
                            <input type="password" name="mdp" class="form-control"
                                placeholder="Entrez votre mot de passe" required="required"
                                data-error="Le mot de passe est requis.">
                        </div>
                        <div class="col-sm-12 mt-4 position-static offset-ms-4">
                            <button type="submit" class="btn btn-info btn-block active" name="bouton">Envoyez</button>
                        </div>
                        <?php echo $msg;?>
                    </form>
                </div>
            </div>
        </section>

        <!-- Formulaire de connexion -->
        <section class="col-sm-5 mx-auto mt-5 position-static">
            <div class="card ">
                <div class="card-body  position-static " id="connexion">
                    <h2 class="card-title ">Connexion</h2>
                    <form class="row" method="post">
                        <div class="col-sm-12">
                            <label for="pseudoCo">Pseudo</label>
                            <input type="text" name="pseudoCo" class="form-control" placeholder="Entrez votre pseudo"
                                required="required" data-error="Le Pseudo est requis.">
                        </div>
                        <div class="col-sm-12 mt-4">
                            <label for="mdpCo">Password</label>
                            <input type="password" name="mdpCo" class="form-control"
                                placeholder="Entrez votre mot de passe">
                        </div>
                        <div class="col-sm-12 mt-4 offset-ms-4">
                            <button type="submit" class="btn btn-info btn-block active">Envoyez</button>
                            <?php echo $msgCo; ?>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</main>
<?php
include '../inc/footer.inc.php';
?>