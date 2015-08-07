<?php
class Database
{
	private $app_db = 'sqlite_php_test.db';
	private $database;
	
	function __construct() {
		$this->database = $this->_getConnection();
		
		if(!$this->database){
			$this->_console_log($this->database->lastErrorMsg());
		} else {
			$this->_console_log('Opened database successfully.');
			$this->createTables();
		}
	}

	function __destruct() {
		try {
			$this->database->close();
		} catch (Exception $ex) {
			$this->_console_log($ex);
		}
	}
	
	function _exec($query) {
		try {
			$result = $this->database->exec($query);
		} catch (Exception $ex) {
			$this->_console_log($ex);
		}
		return $result;
	}

	function _query($query) {
		try {
			$result = $this->database->query($query);
		} catch (Exception $ex) {
			$this->_console_log($ex);
		}
		return $result;
	}

	function _querySingle($query) {
		try {
			$result = $this->database->querySingle($query,true);
		} catch (Exception $ex) {
			$this->_console_log($ex);
		}
		return $result;
	}

	function _prepare($query) {
		try {
			$result = $this->database->prepare($query);
		} catch (Exception $ex) {
			$this->_console_log($ex);
		}
		return $result;
	}

	function _escapeString($string) {
		try {
			$result = $this->database->escapeString($string);
		} catch (Exception $ex) {
			$this->_console_log($ex);
		}
		return $result;
	}
	
	function _console_log($data) {
		if (is_array($data)) $output = "<script>console.log('" . implode(',', $data) . "');</script>";
		else $output = "<script>console.log('" . $data . "');</script>";
		echo $output;
	}
	
	private function _getConnection() {
		$conn = new SQLite3($this->app_db);
		return $conn;
	}
	
	private function createTables() {
		$result = $this->_exec("
			CREATE TABLE IF NOT EXISTS CONTACT_LIST (
				ID 		INTEGER 	NOT NULL PRIMARY KEY AUTOINCREMENT,
				LNAME 	TEXT 		NOT NULL,
				FNAME 	TEXT 		NOT NULL,
				PHONE	CHAR(30),
				EMAIL	CHAR(50)
			)
		");
		$this->checkTableCreation($result, 'CONTACT_LIST');
	}
	
	private function checkTableCreation($result, $table_name) {
		if(!$result){
			$this->_console_log($this->database->lastErrorMsg());
		} else {
			$this->_console_log('Initialized table '.$table_name.'.');
		}
	}
	
}
?>