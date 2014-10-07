<?php
session_start();
require_once('database.php');

$db = new Database();
$db->openConnection();

if (strcmp($_POST['btn-login'],"Login")==0) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$login = $db->isValidLogin($username,$password);
	if ($login) {
		$_SESSION['username'] = $db->getDisplayName($username);
	}else{
		$msg = "Wrong username/password";
	}
	$db->closeConnection();
	Header("Location: index.php?m=".$msg);
	die();
}

if (strcmp($_POST['btn-register'],"Register")==0) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$results = $db->createUser($username,$password);
	if ($results) {
		$message = "User ".$username." is created";
	}else{
		$message = "That user already exists, please choose another username";
	}
	$db->closeConnection();
	Header("Location: index.php?m=".$message);
	die();
}

$db->closeConnection();
Header("Location: index.php");
die();
?>
