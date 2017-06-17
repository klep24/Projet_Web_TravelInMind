<?php

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['session_id']);
	header("Location: index.php");
}
