<?php
session_start();
$username = $_SESSION['username'];
require_once("shoppingcart.php");
require_once("database.php");
$shopping_cart = new Shopping_Cart();
$db = new Database();
$db->openConnection();
$address = $db->getAddress($username);
$db->closeConnection();
?>
<!DOCTYPE html>
<HTML>
   <head>
      <meta charset="utf8">
      <title>ArtShop Deluxe 2016</title>
      <link rel="stylesheet" href="style.css"/>
   </head>
   <body>
      <div class="top">
      	ArtShop Deluxe
      </div>
      <div class="wrapper">
      	<?php
      		if (isset($username)) {
               $street = $address['street'];
               $zipcode = $address['zipcode'];
               $town = $address['town'];
               
               if (strlen($street)==0 || strlen($zipcode)==0 || strlen($town)==0) {
                  echo "<h2>You must submit your address information</h2>";
                  ?>
                  <form id="form-update-address" action="address.php" method="post">
                     <label>
                        <span>Street</span><br>
                        <input type="text" name="txt-street">
                     </label>
                     <label>
                        <br><span>Zipcode</span><br>
                        <input type="text" name="txt-zipcode">
                     </label>
                     <label>
                        <br><span>Town</span><br>
                        <input type="text" name="txt-town">
                     </label>
                     <label>
                        <br><span>&nbsp;</span>
                        <input type="submit" name="btn-update" value="Submit">
                     </label>
                  </form>
                  <?php
                  echo "<br>";
               }else{
                  echo "<strong>Address</strong><br>".$address['street'] . "<br>";
                  echo $address['zipcode'] . " " . $address['town'] . "<br>";
               }

      			echo "<h1>V&#xE4lkommen ".$username."!</h1>";
               echo '<br><br><a href="paymentinfo.php">Edit payment information</a>';
               echo '<br><br><a href="change_pass.php">Change account password</a>';
               echo '<br><a href="logout.php">Logout</a><br>';
      		}else{
      			echo '
      	      <form id="login-form" action="login.php" method="post">
                  <fieldset class="c">
                     <label for="username">Username: </label>
                     <input type="email" name="username" required>
                     <label for="password">Password: </label>
                     <input type="password" name="password" required>
                     <div align="right">
                        <input type="submit" value="Login" id="login" class="button" name="btn-login">
                        <input type="submit" value="Register" id="register" class="button" name="btn-register">
                     </div>
                  </fieldset>
               </form>
               ';
         	}
         ?>
         <div class="entry">
            <figure>
               <a href="onclick.php?id=1"><img src="gallerypic1.jpg" alt="Helianthus" /></a>
               <figcaption>Sten 20 kr</figcaption>
            </figure>
         </div>
         <div class="entry">
            <figure>
               <a href="onclick.php?id=2"><img src="gallerypic2.jpg" alt="Passiflora" /></a>
               <figcaption>Häst 13 kr</figcaption>
            </figure>
         </div>
         <div class="entry">
            <figure>
               <a href="onclick.php?id=3"><img src="gallerypic3.jpg" alt="Nyctocalos" /></a>
               <figcaption>AK-47 250 000 kr</figcaption>
            </figure>
         </div>
         <div class="entry">
            <figure>
               <a href="onclick.php?id=4"><img src="gallerypic4.jpg" alt="Polianthes" /></a>
               <figcaption>Tändstickor £4000</figcaption>
            </figure>
         </div>
         <div class="entry">
            <figure>
               <a href="onclick.php?id=5"><img src="gallerypic5.jpg" alt="Ficus" /></a>
               <figcaption>Ingenting 150 kr</figcaption>
            </figure>
         </div>
         <div class="entry">
            <figure>
               <a href="onclick.php?id=6"><img src="gallerypic6.jpg" alt="Dendrobium" /></a>
               <figcaption>Banan 650/600 kr (exkl./inkl. man)</figcaption>
            </figure>
         </div>
      </div>

      <div class="shopping_cart">
        <?php

         $list = $shopping_cart->getList();
         if(count($list) > 0){
            echo "<ul>";
            foreach ($list as &$value) {
               echo "<li>";
               echo "Produkt-id:" .$value;
               echo "</li>";
            }
         echo "</ul>";
        
         echo '
            <form id="checkout-form" action="checkout.php" method="post">
               <input type="submit" value="Checkout" id="checkout" class="button" name="btn-checkout">
               </div>
            </form>
            '; 
         }
        ?>
      </div>
   </body>
</HTML>
