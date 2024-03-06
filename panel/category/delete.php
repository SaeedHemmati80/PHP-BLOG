<?php

require_once '../../functions/pdo_connection.php';
require_once '../../functions/helper.php';
require_once '../../functions/check-login.php';

if(isset($_GET['cat_id']) && $_GET['cat_id'] !== ''){

    global $conn;
    $sql = "DELETE FROM php_blog.categories WHERE id=?";
    $stmt = $conn ->prepare($sql);
    $stmt -> execute([$_GET['cat_id']]);
}
// if was true and false redirect
redirect('panel/category');

?>
