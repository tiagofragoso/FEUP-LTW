<?php 
	include_once('../includes/session.php');
	
	if (empty($_SESSION['user']))
		die(header('Location: /pages/login.php'));
	
	
	include_once('../templates/common.php');
	include_once('../templates/snippet.php');
	
	include_once('../database/db_user.php');
	$languages = getLanguages();
	
	draw_header('SNIPZ - NEW', array('new-snippet'));
	draw_nav();
	draw_new_snippet($languages, htmlentities($_GET['code']));
	draw_footer();


?>
