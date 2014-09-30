<?php
session_start();
require_once('database.php');

$username = $_SESSION['username'];

if (!isset($username)) {
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
      <div class="wrapper">
<?php

if (isset($_REQUEST['btn-change'])) {
	$new = $_REQUEST['new-password'];
	$new_repeat = $_REQUEST['repeat-password'];
	if (strcmp($new,$new_repeat)==0) {
		//Change password!
		$db = new Database();
		$db->openConnection();
		$rval = $db->changePass($username,$new);
		$db->closeConnection();
		$msg = "Password for " . $username . " is changed!";
	}else{
		$msg = "Passwords do not match!";
	}
}

?>

<link rel="stylesheet" href="style.css">

<?php
echo "<h1>".$msg."</h1>";
?>

<form id="form-change-password" action="change_pass.php" method="post">
	<label>
		<span>New password</span>
		<input type="password" name="new-password">
	</label>
	<label>
		<span>Repeat</span>
		<input type="password" name="repeat-password">
	</label>
	<label>
		<span>&nbsp;</span>
		<input type="submit" name="btn-change" value="Change">
	</label>
</form>
<br>
<a href="index.php">Back</a>


</div>
</body>
</HTML>