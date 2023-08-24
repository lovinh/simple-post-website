<?php
function load_post()
{
    include "database.php";

    $sql = "SELECT * FROM posts";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) < 0) {
        return null;
    }
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_close($conn);

    return $rows;
}
function load_post_detail($post_id)
{
    include "database.php";
    $sql = "SELECT * FROM posts WHERE id = '" . $post_id . "'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) < 0) {
        return null;
    }
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $row;
}
function update_post_view($post_id, $current_view)
{
    include "database.php";
    $sql = "UPDATE posts SET views= '" . ($current_view + 1) . "' WHERE id = '" . $post_id . "'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo "VIEW_UPDATE_ERROR";
    }
}
function get_username($user_id)
{
    include "database.php";
    $sql = "SELECT username FROM users WHERE id = '" . $user_id . "'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) < 0) {
        return null;
    }
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $row["username"];
}
function get_post_comment($post_id)
{
    include "database.php";
    $sql = "SELECT * FROM post_comments WHERE post_id = '" . $post_id . "'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) < 0) {
        return null;
    }
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $row;
}
function set_comment()
{
    include "database.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        login_required();
        $comment = $_POST["userCommentInput"];
        if (empty($comment))
            return "COMMENT_EMPTY_FAIL";
        $sql = "INSERT INTO post_comments(user_id, post_id, use_comment) VALUES ('" . $_SESSION["user_id"] . "','" . $_GET["id"] . "','" . $comment . "')";
        $result = mysqli_query($conn, $sql);
        if (!$result)
            return "COMMENT_UNKNOWN_FAIL";
        else {
            $url = "Location: ./view-post.php?id=" . $_GET["id"];
            header($url);
        }
    }
}
function create_post()
{
    include "database.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "SELECT id FROM posts ORDER BY id DESC LIMIT 1";
        $id_post = 0;
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $id_post = $row["id"] + 1;
        $sql = "INSERT INTO posts(id, author_id, title, body, category) VALUES ('" . $id_post . "', '" . $_SESSION["user_id"] . "', '" . $_POST["post-title"] . "', '" . $_POST["post-body"] . "', '" . $_POST["post-category"] . "')";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        if (!$result) {
            return "CREATE_POST_FAIL";
        } else {
            $location = "Location: ./index.php";
            header($location);
        }
    }
}
