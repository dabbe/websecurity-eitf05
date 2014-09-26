<?php


class Database {
	private $host;
	private $userName;
	private $password;
	private $database;
	private $conn;
	
	/**
	 * Constructs a database object for the specified user.
	 */
	public function __construct($host, $userName, $password, $database) {
		$this->host = $host;
		$this->userName = $userName;
		$this->password = $password;
		$this->database = $database;
	}
	
	/** 
	 * Opens a connection to the database, using the earlier specified user
	 * name and password.
	 *
	 * @return true if the connection succeeded, false if the connection 
	 * couldn't be opened or the supplied user name and password were not 
	 * recognized.
	 */
	public function openConnection() {
		try {
			$this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", 
					$this->userName,  $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			$error = "Connection error: " . $e->getMessage();
			print $error . "<p>";
			unset($this->conn);
			return false;
		}
		return true;
	}
	
	/**
	 * Closes the connection to the database.
	 */
	public function closeConnection() {
		$this->conn = null;
		unset($this->conn);
	}

	/**
	 * Checks if the connection to the database has been established.
	 *
	 * @return true if the connection has been established
	 */
	public function isConnected() {
		return isset($this->conn);
	}
	
	/**
	 * Execute a database query (select).
	 *
	 * @param $query The query string (SQL), with ? placeholders for parameters
	 * @param $param Array with parameters 
	 * @return The result set
	 */
	private function executeQuery($query, $param = null) {
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->execute($param);
			$result = $stmt->fetchAll();
		} catch (PDOException $e) {
			$error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
		return $result;
	}
	
	/**
	 * Execute a database update (insert/delete/update).
	 *
	 * @param $query The query string (SQL), with ? placeholders for parameters
	 * @param $param Array with parameters 
	 * @return The number of affected rows
	 */
	private function executeUpdate($query, $param = null) {

	try {
			$stmt = $this->conn->prepare($query);
			$stmt->execute($param);
			} catch (PDOException $e) {
			$error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
		return count($result);
	}
	
	/**
	 * Check if a user with the specified user id exists in the database.
	 * Queries the Users database table.
	 *
	 * @param userId The user id 
	 * @return true if the user exists, false otherwise.
	 */
	public function userExists($username) {
		$sql = "select username from Users where username = ?";
		$result = $this->executeQuery($sql, array($username));
		return count($result) == 1; 
	}


public function fetchMovieNames() {
		$sql = "SELECT movieName FROM movies";
		$resultSet = $this->executeQuery($sql);
		$result = [];
		for ($i=0; $i < count($resultSet); $i++) {
			array_push($result, $resultSet[$i]["movieName"]);
		}
		return $result;
	}

	public function fetchMoviePerformances($movieName) {
		$sql = "SELECT dates FROM Performances WHERE movieName = ?";
    $resultSet = $this->executeQuery($sql, array($movieName));
    $result = [];
    for ($i=0; $i < count($resultSet); $i++) {
    	array_push($result, $resultSet[$i]["dates"]);
    	}
    return $result;
	}



	public function fetchPerformanceDataTName($movieName, $date) {
		$sql = "SELECT Performances.theatreName From Theatres, Performances WHERE dates = ? and movieName = ? and Performances.theatreName = Theatres.theatreName";
    $resultSet = $this->executeQuery($sql, array($movieName, $date));
	$result = "";
	$result = $resultSet[0]["theatreName"];
	return $result;



   // $result = $resultSet[0]["theatreName"];
	///$result = "";
	///$result = $resultSet[0]["theatreName"];
    //for ($i=0; $i < count($resultSet); $i++) {
    //	array_push($result, $resultSet[$i]["theatreName"]);
   	//	}
	
    return $result;
	}

	public function fetchTheatreSeats($movieName, $date) {
		$sql = "SELECT seats From Theatres, Performances WHERE dates = ? and movieName = ? and Performances.theatreName = Theatres.theatreName";
    $resultSet = $this->executeQuery($sql, array($movieName, $date));
    $result = $resultSet[0]["seats"];
    return $result;
	}



	public function fetchNbrOfBookedSeats($movieName, $date) {
		$movieReservationSQL = "SELECT bookedSeats FROM Performances WHERE dates = ? AND movieName = ? for update";
		$resultSet = $this->executeQuery($movieReservationSQL, array($date, $movieName));
		$result = $resultSet[0]["theatreName"];
		return $result;
	}


	public function makeReservation($movieName, $date) {
		if ($this->fetchAvailableSeats($date, $movieName) == 0) {
			return false;
		}

		$username = $_SESSION['username'];
		
		$this->conn->beginTransaction();
		$theatreName = $this->fetchPerformanceDataTName($movieName, $date);
		$bookedSeats = $this->fetchNbrOfBookedSeats($movieName, $date);
		
		$reservationSQL = "INSERT INTO Reservations(reservationNbr, dates, theatreName, username, movieName) VALUES ('0', ?, ?, ?, ?)";
		$affectedRowsRes = $this->executeUpdate($reservationSQL, array($date, $theatreName, $username, $movieName));

		$updateSQL = "UPDATE Performances SET bookedSeats = ? WHERE dates = ? and movieName = ?";
		
		$affectedRowsUpd = $this->executeUpdate($updateSQL, array($bookedSeats++, $date, $movieName));
		
		if ($affectedRowsRes != 1 || $affectedRowsUpd != 1){
			$this->conn->rollBack();
			return false;
		}
		if ($this->fetchAvailableSeats($date, $movieName) < 0) {
			$this->conn->rollBack();
			return false;
		} else {
			$this->conn->commit();
			return true;
		}
	}

	public function fetchAvailableSeats($date,$movieName) {
		$totalSql = "SELECT seats FROM Theatres, Performances WHERE dates = ? AND movieName = ? AND Performances.theatreName = Theatres.theatreName for update";

     $resultSet = $this->executeQuery($totalSql, array($date, $movieName));
     $theaterSeats = intval($resultSet[0]["seats"]);
     $reservedSeats = intval($this->fetchNbrOfBookedSeats($movieName, $date)[0]["bookedSeats"]);
     

	return $theaterSeats - $reservedSeats;
	}
}
?>
