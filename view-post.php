<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
include "auth.php";
check_for_remembered_user();
include "post.php";
$post_detail = load_post_detail($_GET["id"]);
if (!$post_detail) {
    header("Location: ./404page.php");
}
update_post_view($_GET["id"], $post_detail["views"]);
$post_comment = get_post_comment($_GET["id"]);
set_comment();
$_POST["userCommentInput"] = "";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/view-post.css">
</head>

<body>
    <?php
    include "header.php";
    ?>

    <main>
        <div class="blog-detail card">
            <div class="blog-detail-header">
                <h1 class="blog-detail-header-title">
                    <?php
                    echo $post_detail["title"];
                    ?>
                </h1>
                <div class="blog-detail-header-subtitle">
                    <div class="blog-detail-header-created"><i class="fas fa-calendar"></i>
                        <?php
                        echo $post_detail["created"];
                        ?>
                    </div>
                    <div class="blog-detail-header-author"><i class="fas fa-user"></i>
                        <?php
                        echo get_username($post_detail["author_id"]);
                        ?>
                    </div>
                    <div class="blog-detail-header-view"><i class="fas fa-eye"></i>
                        <?php
                        echo $post_detail["views"];
                        ?>
                    </div>
                </div>
            </div>
            <hr />
            <div class="blog-detail-body">
                <?php
                echo $post_detail["body"];
                ?>
            </div>
            <hr />
            <div class="blog-detail-comment">
                <h2 style="margin-top: 20px;"><i class="fas fa-comment-alt"></i> Comments</h2>
                <div class="blog-detail-comment-container">
                    <div class="blog-detail-comment-scores">
                        <div><button type="button" id="btn-vote-up"><i class="fas fa-sort-up"></i></button></div>
                        <div class="blog-detail-comment-scores-num text-center">
                            <?php
                            if ($post_detail["scores"] > 0) {
                                echo "+";
                            }
                            echo $post_detail["scores"];
                            ?>
                        </div>
                        <div><button type="button"id="btn-vote-down"><i class="fas fa-sort-down" style="size: 30px;"></i></button></div>
                    </div>

                    <div class=" blog-detail-comment-content">
                        <div class="blog-detail-comment-input card">
                            <form method="post">
                                <label for="userCommentInput" class="form-label">Your comment: </label>
                                <input type="text" class="form-control" id="userCommentInput" name="userCommentInput" aria-describedby="emailHelp" placeholder="Enter your comment" required>
                                <button class="btn btn-primary m-2" type="submit">Comment</button>
                            </form>
                        </div>
                        <div class="blog-detail-comment-list">
                            <?php
                            if (!$post_comment) {
                                echo '<div class="blog-detail-comment-item card"> No comments </div>';
                            } else {
                                foreach ($post_comment as $comment) {
                                    echo '<div class="blog-detail-comment-item card"><div class="blog-detail-comment-item-username"> <i class="fas fa-user"></i> ' . get_username($comment["user_id"]) . '</div> <div class="blog-detail-comment-item-text">' . $comment["use_comment"] . '</div> </div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include "footer.php";
    ?>
    <script src="assets/js/header.js"></script>
</body>

</html>