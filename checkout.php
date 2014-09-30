<?php
require_once("shoppingcart.php");
$shopping_cart = new Shopping_Cart();
$list = $shopping_cart->getList();

echo '<link rel="stylesheet" href="style.css"/>';


echo("You tried to buy your items.");
?>