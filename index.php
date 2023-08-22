<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
include "auth.php";
check_for_remembered_user();
include "post.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn PHP</title>
    <link rel="stylesheet" href="assets\bootstrap-5.0.2-dist\css\bootstrap.css">
    <link rel="stylesheet" href="assets\bootstrap-5.0.2-dist\css\bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/icon.png" type="image/x-icon">
    <script src="assets/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</head>

<body>
    <?php
    include "header.php";
    ?>

    <main>
        <div class="blog">
            <?php
            $posts = load_post();
            if (!$posts) {
                echo '<h1 class="m-5 text-center">No post exist!</h1>';
            } else {
                foreach ($posts as $post) {
                    echo '<div class="card m-5"><div class="card-body p-5"><h5 class="card-title">' . $post["title"] . '</h5><h6 class="card-subtitle mb-2 text-muted">' . $post["created"] . '</h6><a href="./view-post.php?id=' . $post["id"] . '" class="card-link">Read post</a></div></div>';
                }
            }
            ?>
        </div>
    </main>
    <?php
    include "footer.php";
    ?>
    <script src="assets/js/header.js"></script>
</body>

</html>