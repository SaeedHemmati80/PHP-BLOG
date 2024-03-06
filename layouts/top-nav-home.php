
<link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css') ?>" media="all" type="text/css">
<link rel="stylesheet" href=" <?= asset('assets/css/style.css') ?>" media="all" type="text/css">
<nav class="navbar navbar-expand-lg navbar-dark bg-blue ">

    <a class="navbar-brand " href="<?= url('panel') ?>">Home Page</a>
    <button class="navbar-toggler " type="button " data-toggle="collapse " data-target="#navbarSupportedContent " aria-controls="navbarSupportedContent " aria-expanded="false " aria-label="Toggle navigation ">
        <span class="navbar-toggler-icon "></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent ">
        <ul class="navbar-nav mr-auto ">
            <li class="nav-item active ">
                <a class="nav-link " href="<?= url('index.php') ?>">Home <span class="sr-only ">(current)</span></a>
            </li>

            <?php
            global $conn;
            $sql = 'select * from php_blog.categories;';
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $categories = $stmt->fetchAll();
            foreach ($categories as $category){
            ?>

            <li class="nav-item ">
                <a class="nav-link " href=""><?= $category->name ?></a>
            </li>

            <?php }?>

        </ul>
    </div>

    <section class="d-inline ">

        <a class="text-decoration-none text-white px-2 " href="<?= url('auth/register.php') ?>">Register</a>
        <a class="text-decoration-none text-white " href="<?= url('auth/login.php') ?>">Login</a>
        <a class="text-decoration-none text-white px-2 " href="<?= url('auth/logout.php') ?> ">Logout</a>

    </section>
</nav>