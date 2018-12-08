<?php
	include_once('../includes/database.php');

	function validLogin($user, $password) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT * FROM User WHERE username=? AND password=?');
		$stmt->execute(array($user, sha1($password)));
		return $stmt->fetch();
	}

	function validUserId($id, $password) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT * FROM User WHERE id=? AND password=?');
		$stmt->execute(array($id, sha1($password)));
		$result = $stmt->fetch();
		if (isset($result)){
			return $result;
		} else {
			return null;
		}
	}

	function registerUser($email, $username, $password) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('INSERT INTO User (email, username, password) VALUES(?, ?, ?)');
		$stmt->execute(array($email, $username, sha1($password)));
		return $db->lastInsertId(); 
	}

	function changePassword($user, $newpassword) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('UPDATE User
		SET password = ? WHERE id = ?');
		return $stmt->execute(array(sha1($newpassword), $user));
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

	function getUser($id) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT User.*
		FROM User
		WHERE User.id = ?');
		$stmt->execute(array($id));
		return $stmt->fetch();
	}

	function getUserByUsername($username) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT User.id 
		FROM User WHERE User.username = ?');
		$stmt->execute(array($username));
		return $stmt->fetch();
	}

	function getUserByEmail($email) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT User.id
		FROM User WHERE User.email = ?');
		$stmt->execute(array($email));
		return $stmt->fetch();
	}

	function getUserSnippets($id) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT Snippet.*, Language.name as languageName
		FROM Snippet, Language 
		WHERE Snippet.author = ? AND Snippet.language = Language.code');
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

	function hasFollow($user1, $user2) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT * FROM FollowUser
		WHERE FollowUser.user1 = ? AND FollowUser.user2 = ?');
		$stmt->execute(array($user1, $user2));
		$res = $stmt->fetch();
		if (empty($res)) {
			return 0;
		} else {
			return 1;
		}
	}
	
	function postLike($user, $snippet, $isLike) {
		$db = Database::instance()->getConnection();
		$pragma = $db->prepare('PRAGMA recursive_triggers = 1');
		$pragma->execute();
		$stmt = $db->prepare('REPLACE INTO SnippetRating(user, snippet, isLike) 
		VALUES (?, ?, ?)');
		return $stmt->execute(array($user, $snippet, $isLike));
	}
	
	function updateUser($user, $username, $name, $email) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('UPDATE User 
		SET username = ?, name = ?, email = ?
		WHERE id = ?');
		return $stmt->execute(array($username, $name, $email, $user));
	}

	function followUser($user1, $user2) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('INSERT INTO FollowUser(user1, user2) VALUES(?, ?)');
		return $stmt->execute(array($user1, $user2));
	}

	function deleteLike($user, $snippet) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('DELETE FROM SnippetRating WHERE user = ? AND snippet = ?');
		return $stmt->execute(array($user, $snippet));
	}

	function unfollowUser($user1, $user2) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('DELETE FROM FollowUser
		WHERE user1 = ? AND user2 = ?');
		return $stmt->execute(array($user1, $user2));
	}

	function getFollowing($id) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT u2.*
		FROM FollowUser, User as u2
		WHERE FollowUser.user1 = ? AND FollowUser.user2 = u2.id');
		$stmt->execute(array($id));
		return $stmt->fetchAll();
	}

	function getFollowers($id) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT u1.*
		FROM FollowUser, User as u1
		WHERE FollowUser.user2 = ? AND FollowUser.user1 = u1.id');
		$stmt->execute(array($id));
		return $stmt->fetchAll();
	}

	function getUserLanguages($id) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT Language.name
		FROM Language, FollowLanguage
		WHERE FollowLanguage.user = ? and FollowLanguage.language = Language.code');
		$stmt->execute(array($id));
		return $stmt->fetchAll();
	}

	function getChannels($id) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT Language.*, COUNT(Snippet.id) AS nr, FollowLanguage.user AS follows
		FROM Language LEFT JOIN Snippet ON (Language.code = Snippet.language)
		LEFT JOIN FollowLanguage ON (Language.code = FollowLanguage.language AND FollowLanguage.user = ?)
		GROUP BY Language.code
		ORDER BY nr DESC, Language.name ASC');
		$stmt->execute(array($id));
		return $stmt->fetchAll();
	}

	function followChannel($user, $language){
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('INSERT INTO FollowLanguage (user, language)
		VALUES(?, ?)');
		$stmt->execute(array($user, $language));
	}

	function unfollowChannel($user, $language){
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('DELETE FROM FollowLanguage
		WHERE user = ? AND language = ?');
		$stmt->execute(array($user, $language));
	}


?>