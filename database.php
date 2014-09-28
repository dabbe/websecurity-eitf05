<?php

define('MYSQL_HOST','localhost');
define('MYSQL_USER','eitf05');
define('MYSQL_PASS','eitfpass');
define('MYSQL_DBNA','eitf05');

class Database {
	private $host;
	private $user;
	private $pass;
	private $dbna;

	public function __construct() {
		$this->host = MYSQL_HOST;
		$this->user = MYSQL_USER;
		$this->pass = MYSQL_PASS;
		$this->dbna = MYSQL_DBNA;
	}

	public function openConnection() {
		try {
			$this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbna;charset=UTF8", 
					$this->user,  $this->pass);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND,"SET NAMES utf8");
		} catch (PDOException $e) {
			$error = "Connection error: " . $e->getMessage();
			print $error . "<p>";
			unset($this->conn);
			return false;
		}
		return true;
	}
	
	public function closeConnection() {
		$this->conn = null;
		unset($this->conn);
	}

	public function isConnected() {
		return isset($this->conn);
	}

	protected function executeQuery($query, $param = null) {
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

	protected function executeSingleRow($query,$param = null) {
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->execute($param);
			$result = $stmt->fetch();
		} catch (PDOException $e) {
			$error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
		return $result;
	}

	protected function executeUpdate($query, $param = null) {
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->execute($param);
			$rows = $stmt->rowCount();
		}catch(PDOException $e) {
			$error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
		return $rows;
	}


	private function userExists($email) {
		$sql = "select email from users where email = ".$email;
		$results = $this->executeQuery($sql);
		if (count($results)>=1) {
			return true;
		}
		return false;
	}

	public function createUser($email,$password) {
		if ($this->userExists($email)) {
			return false;
		}
		$hash = sha1($password);
		$sql = "insert into users (email,password) values ('".$email."','".$hash."')";
		$results = $this->executeQuery($sql);
		return $results;
	}

	public function isValidLogin($username,$password) {
		$hash = sha1($password);
		$sql = "select email,password from users where email = '".$username."' and password '".$hash."'";
		$results = $this->executeQuery($sql);
		if (count($results)==1) {
			return true;
		}
		return false;
	}
}
?>
