<?php
include '../inc/head.inc.php';
include '../inc/header.inc.php'; ?>
<main>
    <section class="sectionTop">
        <h2>Top 3</h2>
        <ul class="Top">
            <div id="top">
                <li><img src="../public/Asset/img/medal1.png" alt="Top1"><?= $top[0]->pseudo  ?></li>
            </div>
            <div class="bot">
                <li><img src="../public/Asset/img/medal2.png" alt="Top2"><?= $top[1]->pseudo ?></li>
                <li><img src="../public/Asset/img/medal3.png" alt="Top3"><?= $top[2]->pseudo ?></li>
            </div>
        </ul>
    </section>
    <section class="classementFriend">
        <h2>Classement de mes Amis</h2>
        <table>
            <thead>
                <tr>
                    <th>Pseudo</th>
                    <th>Point</th>
                    <th>Classement</th>
                </tr>
            </thead>
            <tbody>
                <?php
                var_dump($infosUser[1]);
                foreach ($infosUser as $friend) :
                ?>
                    <tr>
                        <td><?= $friend->pseudo ?></td>
                        <td><?= $friend->point ?></td>
                        <th>1</th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

</main>
<?php include '../inc/footer.inc.php' ?>