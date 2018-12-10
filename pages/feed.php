<?php 
	include_once('../includes/session.php');
	include_once('../templates/common.php');
	include_once('../database/db_user.php');

	draw_header('SNIPZ - FEED', array('like'));
	draw_nav();
	$snippets = empty($_SESSION['user'])? getAllSnippets() : getFeed($_SESSION['user']);
	draw_feed($snippets);
	draw_footer();

?>
