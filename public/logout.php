<?php

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user_id']);
	header("Location: index.php");
    setcookie("user_token", null, "-1" , '/');
    unset($_COOKIE["user_token"]);
}
