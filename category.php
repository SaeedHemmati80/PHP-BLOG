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
    <title>PHP tutorial</title>
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href=" <?= asset('assets/css/style.css') ?>" media="all" type="text/css">
</head>
<body>
<section id="app">

    <?php
    require_once 'layouts/top-nav-home.php';
    ?>

    <section class="container my-5">

        <?php
        $sql = 'select * from php_blog.categories where id =?;';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_GET['cat_id']]);
        $category = $stmt->fetch();
        if ($category !== false) {

            ?>

            <section class="row">
                <section class="col-12">
                    <h1><?= $category->name ?></h1>
                    <hr>
                </section>
            </section>
        <?php } ?>
        <section class="row">

            <?php
            $sql = 'select * from php_blog.posts where cat_id = ? and status = 1;';
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_GET['cat_id']]);
            $posts = $stmt->fetchAll();
            foreach ($posts as $post){
            ?>
            <section class="col-md-2">
                <section class="mb-2 overflow-hidden" style="height:200px; width:150px"
                ">
                <img class="img-fluid" style="width: 100%; height: 100%" src="<?= url($post->image) ?>" alt="">
            </section>
            <h2 class="h5 text-truncate"><?= $post->title ?></h2>
            <p><?= $post->title ?></p>
            <p><a class="btn btn-primary" href="<?= url('detail.php') . $post->cat_id ?>" role="button">View details
                    »</a></p>
        </section>
    <?php
    }
    ?>

    </section>

    <section class="row">
        <section class="col-12">
            <h1>Category not found</h1>
        </section>
    </section>

</section>
</section>

</section>
<script src=" <?= asset('assets/js/jquery.min.js') ?>"></script>
<script src=" <?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>