<?php
	include_once('../includes/session.php');
	include_once('../database/db_user.php');

	$user = $_POST['username'];
	$password = $_POST['password'];

	if (($res = validUser($user, $password))) {
		$_SESSION['user'] = $res['id'];
		$_SESSION['username'] = $res['username'];
		header('Location: ../pages/feed.php');
	} else {
		header('Location: ../pages/login.php');
	}

?>