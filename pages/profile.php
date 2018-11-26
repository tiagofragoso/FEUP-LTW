<?php
include_once('../includes/session.php');
include_once('../templates/common.php');
include_once('../database/db_user.php');

if (!isset($_GET['id'])) {
	if (!isset($_SESSION['user'])){
		die(header('Location: /pages/login.php'));
	}
}

$user = getUser($_GET['id']);

if (!isset($user))
	die("Invalid user id");

$comments = getSnippetComments($_GET['id']);

draw_header('SNIPZ - ' . $snippet['title']);
draw_nav();
draw_full_snippet($snippet, $comments);
draw_footer();

?>