<?php
	include_once('../includes/database.php');

	function validLogin($user, $password) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT * FROM User WHERE username=?');
		$stmt->execute(array($user));
		$row = $stmt->fetch();
		return (!empty($row) && password_verify($password, $row['password']))? $row: false;
	}

	function validUserId($id, $password) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT username FROM User WHERE id=?');
		$stmt->execute(array($id));
		$row = $stmt->fetch();
		return validLogin($row['username'], $password);
	}

	function registerUser($email, $username, $password) {
		$options = ['cost' => 12];
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('INSERT INTO User (email, username, password) VALUES(?, ?, ?)');
		$stmt->execute(array($email, $username, password_hash($password, PASSWORD_DEFAULT, $options)));
		return $db->lastInsertId(); 
	}

	function changePassword($id, $newpassword) {
		$options = ['cost' => 12];
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('UPDATE User
		SET password = ? WHERE id = ?');
		return $stmt->execute(array(password_hash($newpassword, PASSWORD_DEFAULT, $options), $id));
	}

	function getFeed($id) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT Snippet.*, User.username, User.name,
		Language.name AS languageName
		FROM Snippet, User, Language
		WHERE Snippet.author = User.id AND Language.code = Snippet.language
		AND (Snippet.language IN (SELECT language FROM FollowLanguage WHERE FollowLanguage.user = ?)
		OR Snippet.author IN (SELECT user2 FROM FollowUser WHERE user1 = ?))
		ORDER BY Snippet.date DESC');
		$stmt->execute(array($id, $id));
		return $stmt->fetchAll();
	}

	function getAllSnippets() {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT Snippet.*, User.username, User.name,
		Language.name AS languageName
		FROM Snippet, User, Language
		WHERE Snippet.author = User.id AND Language.code = Snippet.language
		ORDER BY Snippet.date DESC');
		$stmt->execute();
		return $stmt->fetchAll();
	}

	function getLanguageSnippets($language) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT Snippet.*, User.username, User.name,
		Language.name As languageName
		FROM Snippet, User, Language
		WHERE Snippet.author = User.id AND Language.code = Snippet.language
		AND Language.code = ?
		ORDER BY Snippet.date DESC');
		$stmt->execute(array($language));
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
		$stmt = $db->prepare('SELECT Snippet.*, User.username, User.name,
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

	function hasLikeComment($user, $comment) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT isLike FROM CommentRating
		WHERE user = ? AND comment = ?');
		$stmt->execute(array($user, $comment));
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

	function postLikeComment($user, $comment, $isLike) {
		$db = Database::instance()->getConnection();
		$pragma = $db->prepare('PRAGMA recursive_triggers = 1');
		$pragma->execute();
		$stmt = $db->prepare('REPLACE INTO CommentRating(user, comment, isLike) 
		VALUES (?, ?, ?)');
		return $stmt->execute(array($user, $comment, $isLike));
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

	function deleteLikeComment($user, $comment) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('DELETE FROM CommentRating WHERE user = ? AND comment = ?');
		return $stmt->execute(array($user, $comment));
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
		$stmt = $db->prepare('SELECT Language.name, Language.code
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

	function getLanguage($code) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT * 
		FROM Language 
		WHERE Language.code = ?');
		$stmt->execute(array($code));
		return $stmt->fetch();
	}

	function searchSnippets($query) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT id, title AS match 
		FROM Snippet 
		WHERE Snippet.title LIKE ?');
		$stmt->execute(array("%{$query}%"));
		return $stmt->fetchAll();
	}

	function searchUsers($query) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT id, name AS match, username 
		FROM User 
		WHERE User.name LIKE ?');
		$stmt->execute(array("%{$query}%"));
		return $stmt->fetchAll();
	}

	function searchChannels($query) {
		$db = Database::instance()->getConnection();
		$stmt = $db->prepare('SELECT code, name AS match
		FROM Language 
		WHERE Language.name LIKE ?');
		$stmt->execute(array("%{$query}%"));
		return $stmt->fetchAll();
	}


?>