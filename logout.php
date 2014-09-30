<?php
require_once("shoppingcart.php");
session_start();
$shopping_cart = new Shopping_Cart();
$shopping_cart->emptyCart();
session_unset();
session_destroy();
Header("Location: index.php");
die();
?>