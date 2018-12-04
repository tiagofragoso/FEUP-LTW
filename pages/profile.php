<?php
include_once('../includes/session.php');
include_once('../templates/common.php');
include_once('../database/db_user.php');
include_once('../templates/profile.php');

if (!isset($_GET['id'])) {
	if (!isset($_SESSION['user'])){
		die(header('Location: /pages/login.php'));
	}
}


$user = getUser($_GET['id']);

if (!isset($user))
die("Invalid user id");

$snippets = getUserSnippets($_GET['id']);
$following = getFollowing($_GET['id']);
$followers = getFollowers($_GET['id']);
$languages = getUserLanguages($_GET['id']);
$comments = getSnippetComments($_GET['id']);
$settings = $_GET['id'] === $_SESSION['user'];

draw_header('SNIPZ - ' . $user['username'], array('follow-user'));
draw_nav();
draw_profile($user, $snippets, $following, $followers, $languages, $settings);
draw_footer();

?>