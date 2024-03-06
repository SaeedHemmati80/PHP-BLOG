<?php

require_once '../../functions/pdo_connection.php';
require_once '../../functions/helper.php';
require_once '../../functions/check-login.php';

global $conn;

if(isset($_GET['post_id']) && $_GET['post_id'] !== ''){

    $sql = "select * from php_blog.posts where id=?;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_GET['post_id']]);
    $post = $stmt->fetch();

    if($_GET['post_id'] !== false){

        $sql = "update php_blog.posts set status=? where id = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->execute([($post->status == 1? 0 : 1), $_GET['post_id']]);

    }


}
redirect('panel/post');

