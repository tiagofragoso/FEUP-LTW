<?php
	include_once('../includes/session.php');
	include_once('../templates/common.php');
	include_once('../templates/authentication.php');

	draw_header('SNIPZ-SIGNUP');
	draw_signup();
	draw_footer();

?>
