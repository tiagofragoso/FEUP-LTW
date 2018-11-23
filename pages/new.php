<?php 
	include_once('../includes/session.php');
	include_once('../templates/common.php');

	draw_header('SNIPZ - NEW');
	draw_nav($_SESSION['user']);
	draw_new_snippet();
	draw_footer();

?>
