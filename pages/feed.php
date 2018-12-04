<?php 
	include_once('../includes/session.php');
	include_once('../templates/common.php');

	draw_header('SNIPZ - FEED', array('like'));
	draw_nav();
	draw_feed();
	draw_footer();

?>
