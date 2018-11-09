<?php 
	include_once('../includes/session.php');
	include_once('../templates/tpl_header.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Feed</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/nav.css">
</head>
<body>
	<?php draw_header($_SESSION['username']); ?>
</body>
</html>