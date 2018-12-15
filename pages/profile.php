<?php
include_once('../includes/session.php');
global $id;
if (empty($_GET['id']) && empty($_SESSION['user'])) {
	die(header('Location: /pages/login.php'));
} else if (empty($_GET['id'])) {	
	$id = $_SESSION['user'];
} else {
	$id = $_GET['id'];
} 

include_once('../database/db_user.php');

$user = getUser($id);
if (empty($user)) {
	die(header('Location: /pages/404.php'));
}


include_once('../templates/common.php');
include_once('../templates/profile.php');

$snippets = getUserSnippets($id);
$following = getFollowing($id);
$followers = getFollowers($id);
$languages = getUserLanguages($id);
$comments = getSnippetComments($id);
$comments = getUserComments($id);
$settings = $id === $_SESSION['user'];

draw_header('SNIPZ - ' . $user['username'], array('follow-user'));
draw_nav();
draw_profile($user, $snippets, $following, $followers, $languages, $settings, $comments);
draw_footer();

?>