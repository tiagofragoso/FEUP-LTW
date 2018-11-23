<?php
	include_once('../database/db_user.php');

	$snippet = file_get_contents($_FILES['snippet']['tmp_name']);
	$currDate = (new DateTime())->format('Y-m-d H:i');
	postSnippet($_POST['title'], $_POST['description'], $snippet, 
	$_POST['language'], $currDate, $_POST['author']);
	header("Location: /pages/feed.php");
?> 