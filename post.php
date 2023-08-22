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
    if (my)
    mysqli_close($conn);
}
