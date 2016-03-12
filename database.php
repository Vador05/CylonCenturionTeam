<?php

class dataBase {
	
	public $host;
	public $user;
	public $password;
	public $dbname;
	public $conn;
	
	function init() {
		$this->host = "mysql.hostinger.es";
		$this->user = "u966699692_c2p";
		$this->password = "c2p1234";
		$this->dbname = "u966699692_crash";
		$this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
			return "Error: " . $this->conn->connect_error;
		}
		else {
			return "OK";
		}
	}
	
	function query($sql) {
		$res = "";
		if ($this->conn->query($sql) === TRUE) {
			$res = "OK";
		} else {
			$res = "Error: " . $this->conn->error;
		}
		return $res;
	}
	
	function answerQuery($sql) {
		$res = $this->conn->query($sql);
		return $res;
	}
	
	function deleteALL($tableName) {
		$sql = "DELETE FROM " . $tableName;
		$res = "";
		if ($this->conn->query($sql) === TRUE) {
			$res = "OK";
		} else {
			$res = "Error: " . $this->conn->error;
		}
		return $res;
	}
	
	function close() {
		$this->conn->close();
	}
}
?>