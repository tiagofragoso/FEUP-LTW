<?php
	include_once('../includes/database.php');

	function validUser($user, $password) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT * FROM user WHERE username=? AND password=?');
		$stmt->execute(array($user, sha1($password)));
		$result = $stmt->fetch();
		if (isset($result)){
			return $result;
		} else {
			return null;
		}
	}

	function registerUser($email, $username, $password) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('INSERT INTO user (email, username, password) VALUES(?, ?, ?)');
		$stmt->execute(array($email, $username, sha1($password)));
	}

	function getSnippets() {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT * FROM Snippet');
		$stmt->execute();
		return $stmt->fetchAll();
	}

	function getSnippet($id) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT Snippet.*, User.username, User.name, User.profilePic 
		FROM Snippet, User 
		WHERE Snippet.id = ? AND Snippet.author = User.id');
		$stmt->execute(array($id));
		return $stmt->fetch();
	}

	function getSnippetComments($id) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT * FROM Comment where snippet = ?');
		$stmt->execute(array($id));
		return $stmt->fetchAll();
	}
	
	function getLanguages() {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT * FROM Language ORDER BY name ASC');
		$stmt->execute();
		return $stmt->fetchAll();
	}

	function postSnippet($title, $description, $snippet, $language, $currDate, $author) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('INSERT INTO Snippet(title, description, code, 
		language, date, author) VALUES (?, ?, ?, ?, ?, ?)');
		$stmt->execute(array($title, $description, $snippet, $language, $currDate, $author));
	}

?>