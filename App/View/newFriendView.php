<?php 
include '../inc/head.inc.php'; 
include '../inc/header.inc.php'; 
?>
<main>
    <a href="../public/index.php?page=friend" class="btn btn-info active" style="float:right; margin-right:40px">Voir
        mes amis</a><br><br>

    <!-- Barre de recherche -->
    <form method="POST" class="form-inline">
        <input name="recherche" class="form-control mr-sm-0" type="search" placeholder="Rechercher" aria-label="Search">

        <button name="button" class="btn btn-outline-success my-2 my-sm-0 active" type="submit">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="white"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                <path fill-rule="evenodd"
                    d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
            </svg>
        </button>
    </form>
    
    <br><br>
    <h2>Les membres</h2>
    <br>

    <!-- Liste des membres inscrit qui ne sont pas encore ami avec l'utilisateur -->
    <table id="newFriend">
        <thead>
            <tr>
                <th>Pseudo</th>
                <th>Statut</th>
                <th>Modifier</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($var[0] as $user):?>
            <tr>
                <td name="pseudo"> <?= $user->pseudo ?> </td>
                <!-- Status du membre : en ligne/hors ligne -->
                <td><?php if($user->statut == 1){
                    echo '<i class="fas fa-circle" style="color: green;"></i>';
                }else{
                    echo '<i class="fas fa-circle" style="color: red;"></i>';
                }  ?></td>
                <!-- Hashage de l'id du membre -->
                <?php $idFriendHash = password_hash($user->id, PASSWORD_DEFAULT); ?>
                <th>
                    <button name="add"> 
                        <a href="index.php?page=NewFriend&id=<?= $idFriendHash ?> ">Ajouter</a>
                    </button>
                </th>
            </tr>
            <?php endforeach ;?>
            <div style="margin-left:25.5%;text-align: center; background-color : orange; width : 49%">
                <?php echo $var[1]; ?></div>
        </tbody>
    </table>
</main>
<?php include '../inc/footer.inc.php' ?>