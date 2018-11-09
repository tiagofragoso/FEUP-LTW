<?php
	class Database {
		private static $instance = NULL;
		private $conn = NULL;

		private function __construct() {
			$this->conn = new PDO('sqlite:../database/snipz.db');
			$this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->conn->query('PRAGMA foreign_keys = ON');
			if (NULL == $this->conn) 
				throw new Exception("Failed to open database");
		}

		public function getConnection() {
			return $this->conn;
		}

		static function instance() {
			if (self::$instance == NULL) {
				self::$instance = new Database();
			}
			return self::$instance;
		}
	}
?>