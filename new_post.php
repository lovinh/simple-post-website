<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
include "auth.php";
check_for_remembered_user();
login_required();
include "post.php";
create_post();
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
    <link rel="stylesheet" href="assets/css/new-post.css">
    <link rel="shortcut icon" href="assets/icon.png" type="image/x-icon">
    <script src="assets/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
    <script src="ckeditor5-39.0.1-gqdzgdippo7m/build/ckeditor.js"></script>
</head>

<body>
    <?php
    include "header.php";
    ?>

    <main>
        <div class="new-post">
            <h1 class="text-center">Create new post</h1>
            <form method="post">
                <div class="new-post-header">
                    <div class="new-post-header-title">
                        <label for="post-title" class="form-label">Your post title:</label>
                        <input type="text" class="form-control" name="post-title" id="post-title" placeholder="Enter your title" required>
                    </div>
                    <div class="new-post-header-category">
                        <label for="post-category" class="form-label">Category:</label>
                        <input type="text" class="form-control" name="post-category" id="post-category" placeholder="Enter your post's category, such as 'new post', 'IT post', 'j4fun',...">
                    </div>
                </div>
                <div class="new-post-body">
                    <label for="post-body" class="form-label">Your post body:</label>
                    <textarea name="post-body" id="post-body" class="form-control" cols="30" rows="10"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </main>
    <?php
    include "footer.php";
    ?>
    <script src="assets/js/header.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#post-body'))
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>