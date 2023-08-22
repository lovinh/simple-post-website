<?php
$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "blog_management";
error_reporting(E_ERROR | E_PARSE);
try {
    $conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);
} catch (Exception) {
    echo "We are not connected!";
}
