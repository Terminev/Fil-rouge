<?php
include '../inc/head.inc.php';
include '../inc/header.inc.php'; ?>
<main>
    <section class="sectionTop">
        <h2>Top 3</h2>
        <ul class="top">
            <li><img src="../public/Asset/img/medal1.png" alt="Top1"><?= $top[0]->pseudo  ?></li>
            <li><img src="../public/Asset/img/medal2.png" alt="Top2"><?= $top[1]->pseudo ?></li>
            <li><img src="../public/Asset/img/medal3.png" alt="Top3"><?= $top[2]->pseudo ?></li>
        </ul>
    </section>

</main>
<?php include '../inc/footer.inc.php' ?>