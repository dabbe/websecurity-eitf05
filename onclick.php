<?php

if (!isset($_COOKIE['shopping_cart'])) {
	setcookie('shopping_cart', json_encode(array()), time()+3600);
}

$shopping_cart = json_decode($_COOKIE['shopping_cart'], true);
$shopping_cart[] = $_GET['id'];
echo("You placed item with id: " .$_GET['id']. " in your shopping cart<br><br>");

setcookie('shopping_cart', json_encode($shopping_cart), time()+3600);

echo "Shopping cart:<br>";
foreach($shopping_cart as &$value)
{ 
	echo $value."<br>";
}
echo "<br>";

  //  Header("Location: index.php");
    //die();

?>	