<?php
	include_once('../includes/database.php');

	function validUser($user, $password) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT * FROM user WHERE username=? AND password=?');
		$stmt->execute(array($user, sha1($password)));
		return $stmt->fetch()? true: false;
	}

	function registerUser($email, $username, $password) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('INSERT INTO user (email, username, password) VALUES(?, ?, ?)');
		$stmt->execute(array($email, $username, sha1($password)));
	}
?>