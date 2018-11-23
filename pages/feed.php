<?php 
	include_once('../includes/session.php');
	include_once('../templates/common.php');

	draw_header('SNIPZ - FEED');
	draw_nav($_SESSION['user']);
	draw_feed();
	draw_footer();

?>
