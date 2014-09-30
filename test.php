<?php
session_start();
require_once('database.php');

$db = new Database();
$db->openConnection();

if (strcmp($_REQUEST['btn-login'],"Login")==0) {
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];

	echo "Trying to login using credentials: ".$username."/".$password;
	$login = $db->isValidLogin($username,$password);
	echo "Results: ".$login;

	if ($login) {
		$_SESSION['username'] = $login[0]['email'];
	}
	$db->closeConnection();
	Header("Location: index.php");
	die();
}

if (strcmp($_POST['btn-register'],"Register")==0) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	echo "Creating user: ".$username;

	var_dump($_POST);

	$results = $db->createUser($username,$password);
	if ($results) {
		$message = "User ".$username." is created";
	}else{
		$message = "That user already exists, pleae choose another username";
	}
	$db->closeConnection();
	Header("Location: index.php?m=".$message);
	die();
}



//$val = $db->createUser($username,$password);

$db->closeConnection();
//	echo($_POST["username"]);
//	echo($val);
//	echo("World");
echo "User: " . $_POST['username'];
echo "<br><br>";
//$_SESSION['username'] = $_POST['username'];
print_r($_POST);
echo "<hr>";
print_r($_SESSION);
Header("Location: index.php");

?>
