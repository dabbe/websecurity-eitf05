<?php
  require_once('database.inc.php');

  session_start();
  $db = $_SESSION['db'];
  $username = $_SESSION['username'];
  $db->openConnection();
  $theatre = $db->fetchPerformanceDataTName($_REQUEST['movieName'], $_REQUEST['dates']);
  $totalSeats = $db->fetchTheatreSeats($_REQUEST['movieName'], $_REQUEST['dates']);
  $availableSeats = $db->fetchAvailableSeats($_REQUEST['movieName'], $_REQUEST['dates']);
  $db->closeConnection();
?>

<html>
<head><title>Booking 3</title><head>
<body><h1>Booking 3</h1>
  Current user: <?php print $username ?>
  <p>
    Movie: <?php print $_REQUEST['movieName'] ?>
  <p>
  <p>
	Theater: <?php print $theatre[0] ?>
  </p>
  <p>
    Performance date: <?php print $_REQUEST['dates'] ?>
  </p>
  <p>
    Total seats: <?php print $totalSeats[0] ?>
  </p>
  <p>
    Seats availiable: <?php print intval($availableSeats) ?>
  </p>
  <form method=post action="booking4.php">
    <input name="movieName" type="hidden" value="<?php print $_REQUEST['movieName'] ?>">
    <input name="theatreName" type="hidden" value="<?php print $theatre ?>">
    <input name="dates" type="hidden" value="<?php print $_REQUEST['dates'] ?>">
    <input type=submit value="Book ticket">
  </form>
</body>
</html>
