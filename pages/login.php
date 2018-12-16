<?php
	include_once('../includes/session.php');

	if (!empty($_SESSION['user'])){
		die(header('Location: ../pages/feed.php'));
	}

	include_once('../templates/common.php');
	include_once('../templates/authentication.php');

	draw_header('SNIPZ-LOGIN', array('auth'));
	draw_login();
	draw_footer();

?>
