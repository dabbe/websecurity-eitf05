<?php
session_start();
$user = $_SESSION['username'];
if (!isset($user)) {
	Header("Location: index.php");
	die();
}

require_once("shoppingcart.php");
$shopping_cart = new Shopping_Cart();
$list = $shopping_cart->getList();

?>

<HTML>
	<head>
		<title>ArtShop Deluxe 2016</title>
		<link rel="stylesheet" href="style.css"/>
		<meta charset="utf-8"/>
	</head>
	<body>
	 <div class="top">
      	ArtShop Deluxe
     </div>
     <div>
     	<?php
     	$list = $shopping_cart->getList();
     	echo 'Din kundkorg innehåller dessa föremål:';
     	foreach($list as &$value){
     		echo '<br>Tavla #' .$value;
     	}
     	?>
     	<form id="buy-form" action="buy.php" method="post">
               <input type="submit" value="Buy" id="buy" name="btn-buy">
        </form>
     </div>
	</body>
</HTML>
