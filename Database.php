<?php 
class Database {
	public $isConnect;
	protected $db;
	// Connect to database
	public function __construct($user='root', $pass = '', $host = 'localhost:3307', $dbname = 'truth', $options=[]) {
		try {
			$this->db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $user, $pass, $options);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$this->isConnect = true;
		} catch (PDOException $e) {
			$this->isConnect = false;
			throw new Exception($e->getMessage());			
		}
	}
	// Disconnect from databse
	public function disconnect() {
		$this->db = null;
		$this->isConnect = false;
	}
	// Get all rows 
	public function getRow($query, $params = []) {
		try {
			$stmt = $this->db->prepare($query);
			$stmt->execute($params);
			return $stmt->fetch();
		} catch (PDOException $e) {
			throw new Exception($e->getMessage());			
		}
	}
	// Get row
	public function getRows($query, $params = []) {
		try {
			$stmt = $this->db->prepare($query);
			$stmt->execute($params);
			return $stmt->fetchAll();
		} catch (PDOException $e) {
			throw new Exception($e->getMessage());			
		}
	}
	// Insert row
	public function insertRow($query, $params = []) {
		try {
			$stmt = $this->db->prepare($query);
			$stmt->execute($params);
			return true;
		} catch (PDOException $e) {
			throw new Exception($e->getMessage());			
		}
	}
	// Update row
	public function updateRow($query, $params = []) {
		$this->insertRow($query, $params);
	}	
	// Delete row
	public function deleteRow($query, $params=[]) {
		$this->insertRow($query, $params);
	}
	// Return last inserted id
	public function lastInsertedId() {
		return $this->db->lastInsertId();
	}
}


