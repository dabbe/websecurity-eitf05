<?php
$host = "localhost";
$username = "eitf05";
$password = "eitfpass";
$database = "eitf05";

$conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("select now()");
$stmt->execute();
$result = $stmt->fetchAll();
?>

<html>
<head><title>PDO Connection Test</title><head>
<body>
<h2>PDO Connection Test</h2>

Now is (fetched from puccini): 
<?php 
    print $result[0][0];
	print ".";
?>
</body>
</html>
