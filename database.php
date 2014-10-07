<?php

define('MYSQL_HOST','localhost');
define('MYSQL_USER','eitf05');
define('MYSQL_PASS','eitfpass');
define('MYSQL_DBNA','eitf05');
define('DEFAULT_HASH_ALG','sha256');

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
		$sql = "select email from users where email = '".$email."'";
		$results = $this->executeQuery($sql);
		if (count($results)>=1) {
			return true;
		}
		return false;
	}

	public function insertPaymentInfo($email, $cardnbr, $cvc, $expiration){
		$sql = "insert into payment_info (email,credit_card_number, credit_card_cvc, credit_card_expiration) values(?,?,?,?) on duplicate key update credit_card_number = ?, credit_card_cvc = ?, credit_card_expiration = ?";
		$results = $this->executeUpdate($sql,array($email,$cardnbr,$cvc,$expiration,$cardnbr,$cvc,$expiration));
		return $results;
	}

	public function getPaymentInfo($email){
		$sql = "select * from payment_info where email='".$email."'";
		return $this->executeQuery($sql);
	}

	public function createUser($email,$password) {
		if ($this->userExists($email)) {
			return false;
		}
		$hash = $this->hash($password);
		$sql = "insert into users (email,password) values ('".$email."','".$hash."')";
		$results = $this->executeUpdate($sql);
		return $results;
	}

	public function isValidLogin($username,$password) {
		$hash = $this->hash($password);
		$sql = "select email,password from users where email = '".$username."' and password = '".$hash."'";
		$results = $this->executeQuery($sql);
		if (count($results)==1) {
			return $results;
		}
		return false;
	}

	public function changePass($user,$pass) {
		$hash = $this->hash($pass);
		$sql = "update users set password = ? where email = ?";
		$results = $this->executeUpdate($sql,array($hash,$user));
		return $results;
	}

	private function hash($pt) {
		$ct = hash(DEFAULT_HASH_ALG,$pt);
		return $ct;
	}

	public function getAddress($user) {
		$sql = "select email,street,zipcode,town from users where email = ?";
		$results = $this->executeSingleRow($sql,array($user));
		return $results;
	}

	public function updateAddress($user,$street,$zipcode,$town) {
		$sql = "insert into users (email,street,zipcode,town) values(?,?,?,?) on duplicate key update street = ?, zipcode = ?, town = ?";
		$results = $this->executeUpdate($sql,array($user,$street,$zipcode,$town,$street,$zipcode,$town));
		return $results;
	}
}
?>
