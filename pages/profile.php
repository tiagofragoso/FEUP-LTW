<?php
include_once('../includes/session.php');
include_once('../templates/common.php');
include_once('../templates/snippet.php');
include_once('../database/db_user.php');

if (!isset($_GET['id']))
	die("Invalid user id");

$user = getUser($_GET['id']);

if (!isset($user))
	die("Invalid user id");

$comments = getSnippetComments($_GET['id']);

draw_header('SNIPZ - ' . $snippet['title']);
draw_nav($_SESSION['user']);
draw_full_snippet($snippet, $comments);
draw_footer();

?>