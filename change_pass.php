<?php

session_start();

$username = $_SESSION['username'];
if (!isset($username)) {
	Header("Location: index.php");
	die();
}
?>

<link rel="stylesheet" href="style.css">
