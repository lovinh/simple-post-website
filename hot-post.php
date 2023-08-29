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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="assets/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</head>

<body>
    <?php
    include "header.php";
    ?>

    <main>
        <h1 class="text-center m-3">Hot posts now:</h1>
        <div class="blog">
            <?php
            $posts = load_post_sort_by("views", true);
            $len = count($posts);
            $n_items = 5;
            if (!$posts) {
                echo '<h1 class="m-5 text-center">No post exist!</h1>';
            } else {
                $s = 0;
                if ($_GET["page"]) {
                    $s = ($_GET["page"] - 1) * $n_items;
                }
                $j = 0;
                foreach ($posts as $post) {
                    if ($j < $s) {
                        $j++;
                        continue;
                    }
                    if ($j - $s == $n_items) {
                        break;
                    }
                    $render = '<div class="card post-item"><div class="card-body"><h5 class="card-title">' . $post["title"] . '</h5><h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-calendar"></i> ' . $post["created"] . '</h6><h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-user"></i> ' . get_username($post["author_id"]) . '</h6><div><a href="./view-post.php?id=' . $post["id"] . '" class="card-link">Read post</a></div></div></div>';
                    if ($post["author_id"] == $_SESSION["user_id"]) {
                        $render = '<div class="card post-item"><div class="card-body"><h5 class="card-title">' . $post["title"] . '</h5><h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-calendar"></i> ' . $post["created"] . '</h6><h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-user"></i> ' . get_username($post["author_id"]) . '</h6><div><a href="./view-post.php?id=' . $post["id"] . '" class="card-link">Read post</a><a href="./edit-post.php?id=' . $post["id"] . '" class="card-link">Edit post</a></div></div></div>';
                    }
                    echo $render;
                    $j++;
                }
            }
            $pagination = '<nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="./hot-post.php?page=' . ($_GET["page"] - 1 >= 1 ? $_GET["page"] - 1 : 1) . '" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>';
            for ($i = 1; $i <= intdiv($len, $n_items) + 1; $i += 1) {
                $pagination = $pagination . '<li class="page-item"><a class="page-link" href="./hot-post.php?page=' . $i . '">' . $i . '</a></li>';
            }

            $pagination = $pagination . '<li class="page-item">
                        <a class="page-link" href="./hot-post.php?page=' . ($_GET["page"] + 1 <= intdiv($len, $n_items) + 1 ? $_GET["page"] + 1 : intdiv($len, $n_items) + 1) . '" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>    
                    </li>
                </ul>
            </nav>';
            echo $pagination;
            ?>

        </div>

    </main>
    <?php
    include "footer.php";
    ?>
    <script src="assets/js/header.js"></script>
</body>

</html>