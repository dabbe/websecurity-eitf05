<?php
	session_start();
	require_once('database.php');
	Header("Location: paymentinfo.php");
	$db = new Database();
	$db->openConnection();
	$db->insertPaymentInfo($_SESSION['username'],$_POST['input-cardnbr'],$_POST['input-cvc'],$_POST['input-expiration']);
	die();
?>