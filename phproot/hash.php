<!DOCTYPE html>
<html>
<head>
<title>SHA1 Hash Generator</title>
</head>
<body>

<?php
echo "Usage: hash.php?hash=[phrase] <br>";
if (isset($_GET['hash'])) {
	echo "SHA1 = " . sha1($_GET['hash']) . "<br>";
}
?>

</body>
</html>
