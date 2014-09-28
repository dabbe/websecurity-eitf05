<?php
session_start();
require_once('database.php');

$db = new Database();
$db->openConnection();

if (strcmp($_POST['btn-login'],"Login")==0) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	echo "Trying to login using credentials: ".$username."/".$password;
	$login = $db->isValidLogin($username,$password);
	echo "Results: ".$login;
}



//$val = $db->createUser($username,$password);

$db->closeConnection();
	
	echo($_POST["username"]);
	echo($val);
	echo("World");*/
echo "User: " . $_POST['username'];
echo "<br><br>";
$_SESSION['username'] = $_POST['username'];
print_r($_POST);
echo "<hr>";
print_r($_SESSION);
Header("Location: index.php");

?>
