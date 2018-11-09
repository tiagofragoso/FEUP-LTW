<?php
	include_once('../includes/session.php');
	include_once('../templates/tpl_auth.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SNIPZ - SIGNUP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="../css/auth.css" />
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
</head>
<body>
	<div class="screen-wrapper">
		<?=draw_signup()?>
	</div>
</body>
</html>