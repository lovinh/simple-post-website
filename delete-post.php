<?php
session_start();
include "post.php";
$post_detail = load_post_detail($_GET["id"]);
if ($post_detail["author_id"] != $_SESSION["user_id"]) {
    header("Location: ./403page.php");
} else {
    delete_post($_GET["id"]);
}
