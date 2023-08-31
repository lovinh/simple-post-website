<header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="./index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <img src="assets/icon.png" alt="" srcset="" width="48" height="48" />
      </a>

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="./" class="nav-link px-2 text-secondary">Home</a></li>
        <li><a href="./category.php" class="nav-link px-2 text-white">Categories</a></li>
        <li><a href="./latest-post.php" class="nav-link px-2 text-white">Latest posts</a></li>
        <li><a href="./hot-post.php" class="nav-link px-2 text-white">Hot posts</a></li>
        <li><a href="./new_post.php" class="nav-link px-2 text-white">New post</a></li>
      </ul>

      <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
        <input type="search" class="form-control form-control-dark" placeholder="Search post..." aria-label="Search" />
      </form>

      <div class="text-end">
        <?php
        if (!empty($_SESSION["user_id"] && !empty($_SESSION["user_username"]))) {
          echo '<button type="button" class="btn btn-outline-light me-2" id="btn-user" onclick="btnUserClick()">' . $_SESSION["user_username"] . '</button>
        <button type="button" class="btn btn-warning" id="btn-logout" onclick="btnLogoutClick()">Logout</button>';
        } else {
          echo '<button type="button" class="btn btn-outline-light me-2" id="btn-login" onclick="btnLoginClick()">Login</button>
        <button type="button" class="btn btn-warning" id="btn-signup" onclick="btnSignupClick()">Sign-up</button>';
        }
        ?>
      </div>
    </div>
  </div>
</header>