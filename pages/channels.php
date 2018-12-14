<?php 
	include_once('../includes/session.php');
	include_once('../templates/common.php');
	include_once('../templates/channel.php');
	include_once('../templates/utils.php');
	include_once('../database/db_user.php');

	if (empty($_GET['code']) || empty($language = getLanguage($_GET['code']))) {
		draw_header('SNIPZ - Channels', array('channels'));
		draw_nav();
		draw_channels();
	} else {
		$snippets = getLanguageSnippets($language['code']);
		draw_header($language['name'], array('language'));
		draw_nav();
		draw_channel($language, $snippets);
	}
	draw_footer();

?>
