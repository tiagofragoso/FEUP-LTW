<?php 
	include_once('../includes/session.php');
	include_once('../templates/common.php');
	include_once('../templates/channel.php');
	include_once('../templates/language.php');

	$language = htmlentities($_GET['code']);

	if (!$language) {
		draw_header('SNIPZ - Channels', array('channels'));
		draw_nav();
		draw_channels();
	} else {
		draw_header('SNIPZ - ' . $language, array('language'));
		draw_nav();
		draw_language($language);
	}
	draw_footer();

?>
