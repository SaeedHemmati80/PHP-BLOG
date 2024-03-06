<?php

require_once '../../functions/pdo_connection.php';
require_once '../../functions/helper.php';
require_once '../../functions/check-login.php';

if(isset($_GET['post_id']) && $_GET['post_id'] !== ''){

    global $conn;
    $sql = "SELECT * FROM php_blog.posts WHERE id=?";
    $stmt = $conn ->prepare($sql);
    $stmt -> execute([$_GET['post_id']]);
    $post = $stmt->fetch();

    $basePath = dirname(dirname(__DIR__));
    if(file_exists($basePath . $post->image)){
        unlink($basePath . $post->image);
    }

    $sql = "DELETE FROM php_blog.posts WHERE id=?";
    $stmt = $conn ->prepare($sql);
    $stmt -> execute([$_GET['post_id']]);
}
redirect('panel/post');
