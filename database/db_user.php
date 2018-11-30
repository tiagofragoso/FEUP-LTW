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
		$stmt = $db->prepare('SELECT Snippet.*, User.username, User.name,
		Language.name AS languageName
		FROM Snippet, User, Language
		WHERE Snippet.author = User.id AND Language.code = Snippet.language
		ORDER BY Snippet.date DESC');
		$stmt->execute();
		return $stmt->fetchAll();
	}

	function getSnippetCommentCount($id) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT Count(*) as count
		FROM Snippet, Comment
		WHERE Snippet.id = ? AND Comment.snippet = Snippet.id');
		$stmt->execute(array($id));
		return $stmt->fetch();
	}

	function getSnippet($id) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT Snippet.*, User.username, User.name, User.profilePic,
		Language.name AS languageName
		FROM Snippet, User, Language
		WHERE Snippet.id = ? AND Snippet.author = User.id AND Language.code = Snippet.language');
		$stmt->execute(array($id));
		return $stmt->fetch();
	}

	function getUserSnippets($id) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT * FROM Snippet, Language 
		WHERE Snippet.user = ? AND Snippet.language = Language.code');
		$stmt->execute(array($id));
		return $stmt->fetchAll();
	}

	function getSnippetComments($id) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT Comment.*, User.username AS username, User.name AS name 
		FROM Comment, User
		WHERE snippet = ? AND Comment.user = User.id');
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
		return $stmt->execute(array($title, $description, $snippet, $language, $currDate, $author));
	}

	function postComment($user, $snippet, $text, $date) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('INSERT INTO Comment(user, snippet, text, date) 
		VALUES (?, ?, ?, ?)');
		return $stmt->execute(array($user, $snippet, $text, $date));
	}

	function hasLike($user, $snippet) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT isLike FROM SnippetRating 
		WHERE user = ? AND snippet = ?');
		$stmt->execute(array($user, $snippet));
		$res = $stmt->fetch();
		if (empty($res)) {
			return 0;
		} else if ($res['isLike']) {
			return 1;
		} else {
			return -1;
		}
	}

	function postLike($user, $snippet, $isLike) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('INSERT INTO SnippetRating(user, snippet, isLike) 
		VALUES (?, ?, ?)');
		return $stmt->execute(array($user, $snippet, $isLike));
	}

	function deleteLike($user, $snippet) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('DELETE FROM SnippetRating WHERE user = ? AND snippet = ?');
		return $stmt->execute(array($user, $snippet));
	}

?>