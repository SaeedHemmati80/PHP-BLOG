<?php
require_once '../../functions/helper.php';
require_once '../../functions/pdo_connection.php';
require_once '../../functions/check-login.php';

global $conn;

// Not set post_id
if(!isset($_GET['post_id'])){
    redirect('panel/post');
}

$sql = "select * from php_blog.posts where id =?;";
$stmt = $conn->prepare($sql);
$stmt->execute([$_GET['post_id']]);
$post = $stmt->fetch();

// Wrong post id
if($post === false){
    redirect('panel/post');
}

// Fields are full
if(
    isset($_POST['title']) && $_POST['title'] ==! '' &&
    isset($_POST['cat_id']) && $_POST['cat_id'] ==! '' &&
    isset($_POST['body']) && $_POST['body'] ==! ''
)
{

    $sql = "SELECT * FROM php_blog.categories WHERE id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt-> execute([$_POST['cat_id']]);
    $category = $stmt->fetch();

    if(isset($_FILES['image']) && $_FILES['image'] !== ''){
        $allow_extension = ['png', 'jpg', 'jpeg', 'gif'];
        $image_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        if(!in_array($image_extension, $allow_extension)){
            redirect('panel/post');
        }

        $base_path = dirname(dirname(__DIR__));

        // exist image
        if(file_exists($base_path . $post->image)){
            unlink($base_path . $post->image);
        }

        $image = '/assets/images/posts/' . date('Y_m_d_H_i_s') . '.' . $image_extension;
        $image_upload = move_uploaded_file($_FILES['image']['tmp_name'], $base_path . $image );

        if($category !== false && $image_upload !== false){

            $sql = "UPDATE php_blog.posts SET title=?, cat_id=?, body=?, image=?, updated_at = NOW() WHERE id = ?;";
            $stmt = $conn->prepare($sql);
            $stmt-> execute([$_POST['title'],$_POST['cat_id'],$_POST['body'], $image, $_GET['post_id']]);

        }
    }
    else{
        if($category !== false){

            $sql = "UPDATE php_blog.posts SET title=?, cat_id=?, body=?, updated_at = NOW() WHERE id=?;";
            $stmt = $conn->prepare($sql);
            $stmt-> execute([$_POST['title'],$_POST['cat_id'],$_POST['body'], $_GET['post_id']]);

        }
    }
    redirect('panel/post');
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP panel</title>
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" media="all" type="text/css">
</head>

<body>
<section id="app">

    <?php
    require_once '../layouts/top-nav-panel.html'
    ?>


    <section class="container-fluid">
        <section class="row">
            <section class="col-md-2 p-0">
                <?php
                require_once '../layouts/sidebar.html'
                ?>
            </section>
            <section class="col-md-10 pt-3">

                <form action="<?= url('panel/post/edit.php?post_id=') . $_GET['post_id'] ?>" method="post" enctype="multipart/form-data">
                    <section class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title"
                               value="<?= $post->title ?>">
                    </section>
                    <section class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                        <img src="<?= asset($post->image) ?>" alt="Image"  class="mt-2" height="100px" width="100px">
                    </section>
                    <section class="form-group">
                        <label for="cat_id">Category</label>
                        <select class="form-control" name="cat_id" id="cat_id">
                            <?php
                            $sql = "SELECT * FROM php_blog.categories;";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $categories = $stmt->fetchAll();

                            foreach ($categories as $category) {
                                ?>

                                <option value="<?= $category->id ?>"><?= $category->name ?></option>

                            <?php } ?>


                        </select>
                    </section>
                    <section class="form-group">
                        <label for="body">Body</label>
                        <textarea class="form-control" name="body" id="body" rows="5"
                                  placeholder="body ..."></textarea>
                    </section>
                    <section class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </section>
                </form>

            </section>
        </section>
    </section>

</section>

<script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
<script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>