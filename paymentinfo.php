<?php
if (!isset($_SESSION['username'])) {
	Header("Location: index.php");
	die();
}
?>

<HTML>
	<head>
		<title>ArtShop Deluxe 2016</title>
		<link rel="stylesheet" href="style.css"/>
	</head>
	<body>
	 <div class="top">
      	ArtShop Deluxe
  	</div>
  	<div align="center">
     	<form id="payment-form" action="sendpaymentinfo.php" method="post">
     		<label for="cardnbr">Card number: </label>
     		<br>
     		<input type="text" id="cardnbr" name="input-cardnbr">
     		<br>
            <label for="cvc">CVC: </label>
            <br>
            <input type="text" id="cvc" name="input-cvc">
            <br>
            <label for="expiration">Expiration Date: </label>
            <br>
            <input type="text" id="expiration"  name="input-expiration">
            <br>
            <input type="submit" id="submitpaymentinfo" value="Submit payment information">
        </form>
	</div>
	</body>
</HTML>
