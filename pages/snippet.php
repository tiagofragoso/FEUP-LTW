<?php
include_once('../includes/session.php');
include_once('../templates/common.php');
include_once('../templates/snippet.php');
include_once('../database/db_user.php');

if (!isset($_GET['id']))
	die("Invalid snippet id");

$snippet = getSnippet($_GET['id']);

if (!isset($snippet))
	die("Invalid snippet id");

$comments = getSnippetComments($_GET['id']);

draw_header('SNIPZ - ' . $snippet['title'], array('like', 'comment', 'snippet'));
draw_nav();
draw_full_snippet($snippet, $comments);
draw_footer();

?>