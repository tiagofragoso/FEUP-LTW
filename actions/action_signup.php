<?php
	include_once('../includes/session.php');
	include_once('../database/db_user.php');

	$email = $_POST['email'];
	$user = $_POST['username'];
	$password = $_POST['password'];

	try {
		registerUser($email, $user, $password);
		$_SESSION['username'] = $user;
		header('Location: ../pages/success.php');
	} catch (PDOException $e) {
		header('Location: ../pages/signup.php');
	}

?>