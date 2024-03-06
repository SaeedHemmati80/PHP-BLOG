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
    <?php

    require_once 'layouts/top-nav-home.php';
    ?>

    <section class="container my-5">
        <!-- Example row of columns -->
        <section class="row">
            <section class="col-md-12">

                <?php
                $sql = 'SELECT php_blog.posts.*, php_blog.categories.name AS cat_name FROM php_blog.posts
                        LEFT JOIN php_blog.categories ON php_blog.posts.cat_id = php_blog.categories.id
                        where posts.status = 1 and posts.id = ?;';
                $stmt = $conn->prepare($sql);
                $stmt->execute([$_GET['post_id']]);
                $post = $stmt->fetch();
                if ($post !== false) {
                ?>

                <h1><?= $post->title ?></h1>
                <h5 class="d-flex justify-content-between align-items-center">
                    <a href="<?= url('category.php?cat_id=') . $post->cat_id ?>"><?= $post->cat_name ?></a>
                    <span class="date-time"><?= $post->created_at ?></span>
                </h5>
                <article class="bg-article p-3">
                    <img class="float-right mb-2 ml-2" style="width: 18rem;" src="" alt=""><?= $post->body ?>
                </article>
                <?php }else{ ?>
                <section><h2>Post Not Found!</h2></section>
                <?php }?>

            </section>
        </section>
    </section>

</section>
<script src=" <?= asset('assets/js/jquery.min.js') ?>"></script>
<script src=" <?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>