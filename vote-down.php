<?php
session_start();
include "post.php";
include "auth.php";
vote_score($_GET["post_id"], false);
