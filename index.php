<?php
session_start();

$username = $_SESSION['username'];
?>

<HTML>
   <head>
      <title>ArtStore Deluxe 2014</title>
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
         	color: #ffffff;
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
         	background-image: url("images/icon.png");
         	padding-left: 20px;
         	background-repeat: no-repeat;}
         fieldset.c {
         	margin:0 auto 0 auto;
         	margin-bottom: 35px;
         	margin-top: 35px;
         }
         body {
    		background-image: url("wp1.jpg");
    		background-size: contain;
    		background-position: fixed;
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
      			echo "<h1>Hej ".$username."!</h1>";
      		}else{
      			echo '
      	
         <form id="login-form" action="test.php" method="post">
            <fieldset class="c">
               <label for="username">Username: </label>
               <input type="text" name="username">
               <label for="password">Password: </label>
               <input type="password" name="password">
               <div align="right">
                  <input type="submit" value="Register" id="register" class="button">
                  <input type="submit" value="Login" id="login" class="button">
               </div>
            </fieldset>
         </form>
         ';
         	}
         ?>
         <div class="entry">
            <figure>
               <img src="gallerypic1.jpg" alt="Helianthus" />
               <figcaption>Helianthus</figcaption>
            </figure>
         </div>
         <div class="entry">
            <figure>
               <img src="gallerypic2.jpg" alt="Passiflora" />
               <figcaption>Passiflora</figcaption>
            </figure>
         </div>
         <div class="entry">
            <figure>
               <img src="gallerypic3.jpg" alt="Nyctocalos" />
               <figcaption>Nyctocalos</figcaption>
            </figure>
         </div>
         <div class="entry">
            <figure>
               <img src="gallerypic4.jpg" alt="Polianthes" />
               <figcaption>Polianthes</figcaption>
            </figure>
         </div>
         <div class="entry">
            <figure>
               <img src="gallerypic5.jpg" alt="Ficus" />
               <figcaption>Ficus</figcaption>
            </figure>
         </div>
         <div class="entry">
            <figure>
               <img src="gallerypic6.jpg" alt="Dendrobium" />
               <figcaption>Dendrobium</figcaption>
            </figure>
         </div>
      </div>
   </body>
</HTML>