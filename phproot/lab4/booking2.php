<?php
  require_once('database.inc.php');

  session_start();
  $db = $_SESSION['db'];
  $username = $_SESSION['username'];
  $db->openConnection();

  $moviePerformances = $db->fetchMoviePerformances($_REQUEST['movieName']);
  $db->closeConnection();
?>

<html>
<head><title>Movie performance</title><head>
<body><h1>Movie performance</h1>
  Current user: <?php print $username ?>
  <p>
  MoviePerformances for '<?php print $_REQUEST['movieName'] ?>':
  <p>
  <form method=post action="booking3.php">
    <select name="dates" size=10>
    <?php
      $first = true;
      foreach ($moviePerformances as $performance) {
        if ($first) {
          print "<option selected>";
          $first = false;
        } else {
          print "<option>";
        }
        print $performance;
      }
    ?>
    </select>
    <input name="movieName" type="hidden" value="<?php print $_REQUEST['movieName'] ?>">
    <input type=submit value="Select date">
  </form>
</body>
</html>
