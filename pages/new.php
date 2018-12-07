<?php 
	include_once('../includes/session.php');
	
	if (empty($_SESSION['user']))
		die(header('Location: /pages/login.php'));
	
	
	include_once('../templates/common.php');
	
	draw_header('SNIPZ - NEW', array('new-snippet'));
	draw_nav();
	draw_new_snippet();
	draw_footer();


?>
