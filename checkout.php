<?php
require_once("shoppingcart.php");
$shopping_cart = new Shopping_Cart();
$list = $shopping_cart->getList();

echo '<title>ArtShop Deluxe 2016</title>';
echo '<link rel="stylesheet" href="style.css"/>';
echo '
	  <div class="top">
      	ArtShop Deluxe
     </div>
	';


echo("You tried to buy your items.");
?>