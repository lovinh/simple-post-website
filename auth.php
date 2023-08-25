<?php
function login()
{
    $error_msg = "";
    include "database.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($username)) {
            return "MISSING_USERNAME";
        }
        if (empty($password)) {
            return "MISSING_PASSWORD";
        }
        $sql = "SELECT * FROM users WHERE username='" . $_POST["username"] . "' AND password= '" . $_POST["password"] . "'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) <= 0) {
            return "WRONG_USERNAME_PASSWORD";
        }
        $row = mysqli_fetch_assoc($result);
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["user_username"] = $row["username"];

        // Save cookie
        if (isset($_POST["remember-me"])) {
            setcookie("user_id_remembered", $_SESSION["user_id"], time() + 86400 * 3, "/");
        }

        header("Location: ./index.php");
    }
    mysqli_close($conn);
    return $error_msg;
}
function logout()
{
    session_destroy();
    setcookie("user_id_remembered", $_SESSION["user_id"], time() + 0, "/");
    header("Location: ./login.php");
}

function login_required()
{
    // echo "LOGIN REQUIRED CHECK";
    if (!$_SESSION["user_id"]) {
        header("Location: ./login.php");
        return true;
    }
    return false;
}
function check_for_remembered_user()
{
    if ($_COOKIE["user_id_remembered"]) {
        include "database.php";
        $sql = "SELECT * FROM users WHERE id='" . $_COOKIE["user_id_remembered"] . "'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["user_username"] = $row["username"];
        }
    }
}
function register()
{
    include "database.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $password_again = filter_input(INPUT_POST, "password-again", FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($username)) {
            return "MISSING_USERNAME";
        }
        if (empty($password)) {
            return "MISSING_PASSWORD";
        }
        if (empty($password_again)) {
            return "MISSING_REENTER_PASSWORD";
        }
        if (strcmp($password, $password_again)) {
            return "PASSWORD_NOT_MATCH";
        }
        $sql = "SELECT * FROM users WHERE username='" . $username . "'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            return "USED_USERNAME";
        }
        $sql = "select id from users ORDER BY id DESC LIMIT 1";
        $id = 0;
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $id = $row["id"] + 1;
        }

        $sql = "INSERT INTO users(id, username, password) VALUES (" . $id . ",'" . $username . "','" . $password . "')";

        if (!mysqli_query($conn, $sql)) {
            return "REGISTER_FAIL";
        }
        $_SESSION["user_id"] = $id;
        $_SESSION["user_username"] = $username;

        // Save cookie
        if (isset($_POST["remember-me"])) {
            setcookie("user_id_remembered", $id, time() + 86400 * 3, "/");
        }

        header("Location: ./index.php");
    }
    mysqli_close($conn);
}
