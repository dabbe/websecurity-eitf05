<?php
session_start();
$username = $_SESSION['username'];
?>

<HTML>
   <head>
      <title>ArtShop Deluxe 2016</title>
      <style type="text/css">
         * {
         font-family: Arial, Verdana, sans-serif;
         color: #000000;	
         margin: 0;		
         }
         input {
         border-top: none;
         border-right: none;
         border-left: none;
         padding: 5px;
         width: 280px;
         margin-bottom: 20px;}
         input.button {
         color: #ffffff;
         background-color: #882255;
         border: none;
         width: 100px;
         border-radius: 5px;
         }
         .top{
         	text-align: center;
         	font-size: 110;
         	 -webkit-text-stroke: 2px white;
           	margin: 0px;

         	padding-top: 50px;
         	vertical-align: middle;
         	padding-bottom: 50px;
         }
         fieldset {
         height: 160px;
         width: 300px;
         border: 1px solid #000000;
         border-radius: 10px;
         padding: 20px;
         text-align: left;}
         .wrapper {
         width: 720px;
         margin: 0px auto;
         position:relative;
         }
         .header {
         margin: 40px 0px 20px 0px;}
         .entry {
         	width: 220px;
         	float: left;
         	margin: 10px;
         	height: 198px;
         	background-image: url("images/shadow.png");
         	background-repeat: no-repeat;
         	background-position: bottom;}
         .entry:after {
         	clear:left;
         }
         figure {
         	display: block;
         	width: 202px;
         	height: 170px;
         	background-color: #e7e3d8;
         	margin: 0px;
         	padding: 9px;
         	text-align: left;}
         figure img {
        	 width: 200px;
         	height: 150px;
         	border: 1px solid #d6d6d6;}
         img:hover {
         	border:1px solid #0000ff;
         }
         form#login-form {
         	margin:0 auto 0 auto;
         }
         figcaption {
         	/*background-image: url("images/icon.png");*/
         	padding-left: 20px;
         	background-repeat: no-repeat;}
         fieldset.c {
         	margin:0 auto 0 auto;
         	margin-bottom: 35px;
         	margin-top: 35px;
         }
         body {
    		background-image: url("bg.png");
         }
         .shopping_cart {
            padding: 20px;
            color: #CCCCCC;
         }
      </style>
   </head>
   <body>
      <div class="top">
      	ArtShop Deluxe
      </div>
      <div class="wrapper">
      	<?php
      		if (isset($username)) {
      			echo "<h1>V&#xE4lkommen ".$username."!</h1>";
               echo '<br><br><a href="logout.php">Logout</a><br>';
      		}else{
      			echo '
      	
         <form id="login-form" action="test.php" method="post">
            <fieldset class="c">
               <label for="username">Username: </label>
               <input type="text" name="username">
               <label for="password">Password: </label>
               <input type="password" name="password">
               <div align="right">
                  <input type="submit" value="Register" id="register" class="button" name="btn-register">
                  <input type="submit" value="Login" id="login" class="button" name="btn-login">
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
         require_once("shoppingcart.php");

         $shopping_cart = new Shopping_Cart();
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
