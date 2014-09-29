<?php

require_once("shoppingcart.php");
Header("Location: index.php");
$shopping_cart = new Shopping_Cart();
if(isset($_GET['id'])){
	$shopping_cart->add($_GET['id']);	
}
die();
?>	