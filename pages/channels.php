<?php 
	include_once('../includes/session.php');
	include_once('../templates/common.php');
	include_once('../templates/channel.php');

	draw_header('SNIPZ - Channels', array('channels'));
	draw_nav();
	draw_channels();
	draw_footer();

?>
