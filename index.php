<?php
session_start();
$username = $_SESSION['username'];
require_once("shoppingcart.php");
$shopping_cart = new Shopping_Cart();
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
      <div class="wrapper">
      	<?php
      		if (isset($username)) {
      			echo "<h1>V&#xE4lkommen ".$username."!</h1>";
               echo '<br><br><a href="paymentinfo.php">Edit payment information</a>';
               echo '<br><a href="logout.php">Logout</a><br>';
      		}else{
      			echo '
      	      <form id="login-form" action="test.php" method="post">
                  <fieldset class="c">
                     <label for="username">Username: </label>
                     <input type="text" name="username">
                     <label for="password">Password: </label>
                     <input type="password" name="password">
                     <div align="right">
                        <input type="submit" tabindex="2" value="Register" id="register" class="button" name="btn-register">
                        <input type="submit" tabindex="1" value="Login" id="login" class="button" name="btn-login">
                     </div>
                  </fieldset>
               </form>
               ';
         	}
         ?>
         <div class="entry">
            <figure>
               <a href="onclick.php?id=1"><img src="gallerypic1.jpg" alt="Helianthus" /></a>
               <figcaption>Helianthus</figcaption>
            </figure>
         </div>
         <div class="entry">
            <figure>
               <a href="onclick.php?id=2"><img src="gallerypic2.jpg" alt="Passiflora" /></a>
               <figcaption>Passiflora</figcaption>
            </figure>
         </div>
         <div class="entry">
            <figure>
               <a href="onclick.php?id=3"><img src="gallerypic3.jpg" alt="Nyctocalos" /></a>
               <figcaption>Nyctocalos</figcaption>
            </figure>
         </div>
         <div class="entry">
            <figure>
               <a href="onclick.php?id=4"><img src="gallerypic4.jpg" alt="Polianthes" /></a>
               <figcaption>Polianthes</figcaption>
            </figure>
         </div>
         <div class="entry">
            <figure>
               <a href="onclick.php?id=5"><img src="gallerypic5.jpg" alt="Ficus" /></a>
               <figcaption>Ficus</figcaption>
            </figure>
         </div>
         <div class="entry">
            <figure>
               <a href="onclick.php?id=6"><img src="gallerypic6.jpg" alt="Dendrobium" /></a>
               <figcaption>Dendrobium</figcaption>
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
