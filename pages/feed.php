<?php 
	include_once('../includes/session.php');
	if (empty($_GET['mode'])) {
		$mode = empty($_SESSION['user'])? 'all' : 'feed';
	} else {
		if ($_GET['mode'] !== 'all' && $_GET['mode'] !== 'feed') {
			die(header('Location: /pages/404.php'));
		} else {
			if ($_GET['mode'] === 'feed' && empty($_SESSION['user'])){
				die (header('Location: /pages/login.php'));
			}
		}
		$mode = $_GET['mode'];
	}

	if (empty($_GET['sort'])) {
		$sort = 'latest';
	} else {
		if ($_GET['sort'] !== 'latest' && $_GET['sort'] !== 'oldest' && $_GET['sort'] !== 'best') {
			die(header('Location: /pages/404.php'));
		} 
		$sort = $_GET['sort'];
	}

	switch ($mode) {
		case 'all':
			$func = 'getAllSnippets';
			$args = array();
			break;
		case 'feed':
			$func = 'getFeed';
			$args = array($_SESSION['user']);
			break;
	}
	switch ($sort) {
		case 'latest':
			array_push($args, 'date(Snippet.date)', 'DESC', 10, 0);
			break;
		case 'oldest':
			array_push($args, 'date(Snippet.date)', 'ASC', 10, 0);		
			break;
		case 'best':
			array_push($args, 'Snippet.points', 'DESC', 10, 0);
			break;
	}

	include_once('../templates/common.php');
	include_once('../database/db_user.php');

	draw_header('SNIPZ - FEED', array('like', 'feed'));
	draw_nav();
	$snippets = call_user_func_array($func, $args);
	draw_feed($snippets, $mode, $sort);
	draw_footer();

?>
