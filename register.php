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
        <form action="register.php" method="post">
            <img class="mb-4" src="assets/icon.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 fw-normal">Please sign up</h1>
            <div>
                <?php
                $error_msg = register();
                if ($error_msg == "MISSING_USERNAME") {
                    echo '<div class="alert alert-danger" role="alert">Enter an username!</div>';
                }
                if ($error_msg == "MISSING_PASSWORD") {
                    echo '<div class="alert alert-danger" role="alert">Enter a password!</div>';
                }
                if ($error_msg == "MISSING_REENTER_PASSWORD") {
                    echo '<div class="alert alert-danger" role="alert">Reenter your password!</div>';
                }
                if ($error_msg == "PASSWORD_NOT_MATCH") {
                    echo '<div class="alert alert-danger" role="alert">Password does not match!</div>';
                }
                if ($error_msg == "USED_USERNAME") {
                    echo '<div class="alert alert-danger" role="alert">Your username has been used!</div>';
                }
                if ($error_msg == "REGISTER_FAIL") {
                    echo '<div class="alert alert-danger" role="alert">Fail to sign up! Something went wrong!</div>';
                }
                ?>
            </div>
            <div class="form-floating m-1">
                <input type="text" class="form-control" id="floatingInput" name="username" placeholder="Username">
                <label for="floatingInput">Your username</label>
            </div>
            <div class="form-floating m-1">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                <label for="floatingPassword">Your password</label>
            </div>
            <div class="form-floating m-1">
                <input type="password" class="form-control" id="floatingPassword" name="password-again" placeholder="Password">
                <label for="floatingPassword">Confirm your password</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" name="remember-me" value="remember-me"> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
            <div class="mt-5 mb-3">Have an account?
                <a href="./login.php">Sign in</a>
            </div>
        </form>
    </main>

</body>

</html>
<?php
