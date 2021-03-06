<?php
session_start();
require_once('database.php');

$username = $_SESSION['username'];

if (!isset($username)) {
	Header("Location: index.php");
	die();
}

require_once('csrf.php');

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
	$rval = Csrf::check("change",$_POST);
	if (!$rval) {
		session_unset();
		session_destroy();
		Header("Location: index.php");
		die();
	}

	$old = $_POST['old-password'];
	$new = $_POST['new-password'];
	$new_repeat = $_POST['repeat-password'];
	if (strcmp($new,$new_repeat)==0) {
		//Change password!
		$db = new Database();
		$db->openConnection();
		$rval = $db->changePass($username,$new,$old);
		$db->closeConnection();
		if ($rval) {
			$msg = "Password for " . $username . " is changed!";
		}else{
			$msg = "Could not change password";
		}
	}else{
		$msg = "Passwords do not match!";
	}
}

?>

<link rel="stylesheet" href="style.css">

<?php
$token = Csrf::generate("change");
echo "<h1>".$msg."</h1>";
?>

<form id="form-change-password" action="change_pass.php" method="post">
<input type="hidden" value="<?php echo $token;?>" name="change">
	<label>
		<span>Current password</span>
		<input type="password" name="old-password" required>
	</label>
	<label>
		<span>New password</span>
		<input type="password" name="new-password" required>
	</label>
	<label>
		<span>Repeat</span>
		<input type="password" name="repeat-password" requirewd>
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