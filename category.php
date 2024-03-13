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
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" media="all" type="text/css">
</head>
<body>
<section id="app">
    <?php require_once "layouts/top-nav-home.php" ?>

    <section class="container my-5">

        <?php
        $notFound = false;
        if (isset($_GET['cat_id']) && $_GET['cat_id'] !== '') {
        $query = 'SELECT * FROM php_blog.categories WHERE id = ?';
        $statement = $conn->prepare($query);
        $statement->execute([$_GET['cat_id']]);
        $category = $statement->fetch();
        if ($category !== false) {
        ?>

        <section class="row">
            <section class="col-12">
                <h1><?= $category->name ?></h1>
                <hr>
            </section>
        </section>
        <section class="row">
            <?php
            $query = "SELECT * FROM php_blog.posts WHERE status = 1 AND cat_id = ?;";
            $statement = $conn->prepare($query);
            $statement->execute([$_GET['cat_id']]);
            $posts = $statement->fetchAll();
            foreach ($posts as $post) {
                ?>

                <section class="col-md-2">
                    <section class="mb-2 overflow-hidden" style="height: 200px; width: 150px">
                        <img class="img-fluid" style="height: 100%; width: 100%" src="<?= url($post->image) ?>" alt=""></section>
                    <h2 class="h5 text-truncate"><?= $post->title ?></h2>
                    <p><?= substr($post->body, 0, 15) ?>...</p>
                    <p><a class="btn btn-primary" href="<?= url('detail.php?post_id=' . $post->id) ?>" role="button">View
                            details »</a></p>
                </section>

                <?php
            }
            }
            else {
                $notFound = true;
            }
            } else {
                $notFound = true;
            }

            ?>

        </section>
        <?php
        if ($notFound) { ?>
            <section class="row">
                <section class="col-12">
                    <h1>Category not found</h1>
                </section>
            </section>
        <?php } ?>

    </section>
</section>

</section>
<script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
<script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>