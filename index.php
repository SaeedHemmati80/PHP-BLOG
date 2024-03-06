<?php
require_once 'functions/helper.php';
require_once 'functions/pdo_connection.php';
global $conn;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Blog</title>
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href=" <?= asset('assets/css/style.css') ?>" media="all" type="text/css">
</head>
<body>
<section id="app">

    <?php require_once "layouts/top-nav-home.php" ?>

    <section class="container my-5">
        <!-- Example row of columns -->
        <section class="row">
            <?php
            $sql = 'select * from php_blog.posts where status = 1;';
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $posts = $stmt->fetchAll();

            foreach ($posts as $post) {
                ?>
                <section class="col-md-2">
                    <section class="mb-2 overflow-hidden" style="height: 200px; width: 150px">
                        <img class="img-fluid" style="width: 100%; height: 100%" src="<?= asset($post->image) ?>"
                             alt="">
                    </section>
                    <h2 class="h5 text-truncate"><?= $post->title ?></h2>
                    <p><?= substr($post->body, 0, 15) . '...' ?></p>
                    <p><a class="btn btn-primary" href="<?= url('detail.php?post_id=') . $post->id ?>" role="button">View details »</a></p>
                </section>
            <?php } ?>

        </section>
    </section>

</section>
<script src=" <?= asset('assets/js/jquery.min.js') ?>"></script>
<script src=" <?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>