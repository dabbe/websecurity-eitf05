<?php
session_start();
require_once("database.php");
$username = $_SESSION['username'];

if (!isset($username)) {
	Header("Location: index.php");
	die();
}

$street = $_POST['txt-street'];
$zipcode = $_POST['txt-zipcode'];
$town = $_POST['txt-town'];

$db = new Database();
$db->openConnection();
$results = $db->updateAddress($username,$street,$zipcode,$town);
$db->closeConnection();

if ($results) {
	Header("Location: index.php");
	die();
}

var_dump($results);

?>