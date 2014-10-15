<?php
session_start();
$user = $_SESSION['username'];
if (!isset($user)) {
	Header("Location: index.php");
	die();
}
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
     <div align="center">
     	Tack för köpet!<br>
		Du har köpt:<br>
     	<?php
     		require_once("shoppingcart.php");
     		require_once("database.php");
			$cart = new Shopping_Cart();
			$list = $cart->getList();

			$db = new Database();
			$db->openConnection();
			$address = $db->getAddress($user);

			foreach($list as $value){
				echo 'Föremål #'.$value."<br>";
			}
			echo 'som kommer att levereras om 3 dagar till adressen:<br><br>';
			$street = $address['street'];
            $zipcode = $address['zipcode'];
            $town = $address['town'];
			echo $street . "<br>" . $zipcode . " " . $town . "<br>";
			echo 'Tack för idag och ses i morgon eller igår! :)';
			$cart->emptyCart();
     	?>
     </div>
	</body>
</HTML>
