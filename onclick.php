<?php

require_once("shoppingcart.php");
session_start();
Header("Location: index.php");
if(isset($_SESSION['username'])){
	$shopping_cart = new Shopping_Cart();
	if(isset($_GET['id'])){
		$shopping_cart->add($_GET['id']);	
	}
}
die();
?>	
