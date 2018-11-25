<?php
	include_once('../includes/session.php');

	if (isset($_SESSION['user'])){
		die(header('Location: feed.php'));
	}

	include_once('../templates/common.php');
	include_once('../templates/authentication.php');

	draw_header('SNIPZ-LOGIN');
	draw_login();
	draw_footer();

?>
