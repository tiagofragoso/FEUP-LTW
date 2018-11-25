<?php
	include_once('../database/db_user.php');
	$currDate = (new DateTime())->format('Y-m-d H:i');
	postComment($_POST['user'], $_POST['snippet'], 
	$_POST['text'], $currDate);
	header("Location: /pages/snippet.php?id=" . $_POST['snippet']);
?> 