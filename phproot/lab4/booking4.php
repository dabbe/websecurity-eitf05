<?php
  require_once('database.inc.php');

  session_start();
  $db = $_SESSION['db'];
  $username = $_SESSION['username'];
  $db->openConnection();
  $reservationStatus = $db->makeReservation(intval($_REQUEST['movieName'], $_REQUEST['dates']));
  $db->closeConnection();
?>

<html>
<head><title>Booking 4</title><head>
<body><h1>Booking 4</h1>
  <a href="booking1.php">New booking</a>
  <p>
    <?php
      if ($reservationStatus == true) {
        print "Reservation made";
      } else {
        print "Performance is already booked up";
      }
    ?>
  </p>
</body>
</html>
