<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
include "auth.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/bootstrap-5.0.2-dist/css/bootstrap.css">
    <script src="assets/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="shortcut icon" href="assets/icon.png" type="image/x-icon">
</head>

<body class="text-center">

    <main class="form-signin w-100 m-auto">
        <form action="login.php" method="post">
            <img class="mb-4" src="assets/icon.png" alt="" width="72" height="72">

            <h1 class="h3 mb-3 fw-normal">Please log in</h1>
            <?php
            $error_msg = login();
            if ($error_msg == "MISSING_USERNAME") {
                echo '<div class="alert alert-danger" role="alert">Enter an username</div>';
            }
            if ($error_msg == "MISSING_PASSWORD") {
                echo '<div class="alert alert-danger" role="alert">Enter a password</div>';
            }
            if ($error_msg == "WRONG_USERNAME_PASSWORD") {
                echo '<div class="alert alert-danger" role="alert">Your username or your password is incorrect!</div>';
            }
            ?>
            <div class="form-floating m-1">
                <input type="text" class="form-control" id="floatingInput" name="username" placeholder="Username">
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating m-1">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" name="remember-me" value="remember-me"> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            <div class="mt-5 mb-3">Don't have account? <a href="./register.php">Sign up</a> </div>

        </form>
    </main>

</body>

</html>