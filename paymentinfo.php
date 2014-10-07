<?php
session_start();
require_once("database.php");
$user = $_SESSION['username'];
if (!isset($user)) {
	Header("Location: index.php");
	die();
}

$db = new Database();
$db->openConnection();
$result = $db->getPaymentInfo($user);
$row = $result[0];

$cardnbr = $row['credit_card_number'];
$cvc = $row['credit_card_cvc'];
$expiration = date('Y-m-d', strtotime($row['credit_card_expiration']))

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
     		<input type="text" id="cardnbr" name="input-cardnbr" value=<?php echo '"' .$cardnbr. '"'; ?>>
     		<br>
            <label for="cvc">CVC: </label>
            <br>
            <input type="text" id="cvc" name="input-cvc" value=<?php echo '"' .$cvc. '"'; ?>>
            <br>
            <label for="expiration">Expiration Date: </label>
            <br>
            <input type="text" id="expiration"  name="input-expiration" value=<?php echo '"' .$expiration. '"'; ?>>
            <br>
            <input type="submit" id="submitpaymentinfo" value="Submit payment information">
        </form>

        <a href="http://dev.hawry.net/eitf05/index.php">Back</a>
	</div>
	</body>
</HTML>
