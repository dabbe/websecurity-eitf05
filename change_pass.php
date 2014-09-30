<?php
session_start();
require_once('database.php');

$username = $_SESSION['username'];

if (!isset($username)) {
	Header("Location: index.php");
	die();
}

if (isset($_REQUEST['btn-change'])) {
	$new = $_REQUEST['new-password'];
	$new_repeat = $_REQUEST['repeat-password'];
	if (strcmp($new,$new_repeat)==0) {
		//Change password!
		$db = new Database();
		$db->openConnection();
		$rval = $db->changePass($username,$new);
		$db->closeConnection();
		$msg = "Password for " . $username . " is changed! (Status=" . $rval . ")";
	}else{
		$msg = "Passwords do not match!";
	}
}

?>

<link rel="stylesheet" href="style.css">

<?php
echo "<h1>".$msg."</h1>";
?>

<form action="change_pass.php" method="post">
	New password: <input type="password" name="new-password"><br>
	Repeat: <input type="password" name="repeat-password"><br>
	<input type="submit" name="btn-change" value="Change">
</form>
<br>
<a href="index.php">Back</a>