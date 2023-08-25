<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
include "auth.php";
check_for_remembered_user();
login_required();
include "post.php";
$post_detail = load_post_detail($_GET["id"]);
if ($post_detail["author_id"] != $_SESSION["user_id"]) {
    header("Location: ./403page.php");
}
update_post($_GET["id"]);
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
            <h1 class="text-center">Edit your post</h1>
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
                <button type="submit" class="btn btn-success">Save change</button>
                <button type="button" class="btn btn-danger" onclick="btnDeleteClick()">Delete post</button>

            </form>
        </div>
    </main>
    <?php
    include "footer.php";
    ?>
    <script src="assets/js/header.js"></script>
    <script>
        let editor;
        document.getElementById("post-title").value = "<?php echo $post_detail["title"] ?>";
        document.getElementById("post-category").value = "<?php echo $post_detail["category"] ?>";
        document.getElementById("post-body").value =
            '<?= $post_detail["body"]; ?>';
        console.log(document.getElementById("post-body").value);
        ClassicEditor
            .create(document.querySelector('#post-body'))
            .then(newEditor => {
                editor = newEditor;
            })
            .catch(error => {
                console.error(error);
            });

        function btnDeleteClick() {
            process = window.confirm("Are you sure to delete this post?");
            if (process) {
                location.href = "./delete-post.php?id=<?php echo $_GET["id"] ?>";
            }
        }
    </script>
</body>

</html>