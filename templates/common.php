<?php
	function draw_header($title) {
?>
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title><?=$title?></title>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" type="text/css" media="screen" href="/css/style.css" />
			<link rel="stylesheet" type="text/css" media="screen" href="/css/auth.css" />
			<link rel="stylesheet" type="text/css" media="screen" href="/css/nav.css" />
			<link rel="stylesheet" type="text/css" media="screen" href="/prism.css" />
			<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
			<script src="/prism.js"></script>
		</head>
		<body>
<?php
	}
?>

<?php
	function draw_nav($user) {
?>
		<nav>
			<div class="nav-wrapper">
				<?php include("../includes/logo.php") ?>
				<div class="menu">
					<div class="search">
						<!-- input form -->
					</div>
					<?php if (isset($user)) { ?>
					<a href="../actions/action_logout.php">Logout</a>
				<?php } else { ?>
					<a href="../pages/login.php">Login</a>
				<?php } ?>
				</div>
			</div>
		</nav>
<?php
	}
?>

<?php
	include_once('../database/db_user.php');
	function draw_feed() {
		$snippets = getSnippets();
?>
	<div class="main-content center">
		<?php foreach ($snippets as $snippet) { 
			$lang = 'language-' . $snippet['language']; ?>
			 <div class="snippet-wrapper">
				 <header class="toolbar">
					 <span class="title"><?=$snippet['title']?></span>
					 <span class="language"><?=$snippet['language']?></span>
				 </header>
				 <a href="/pages/snippet.php?id=<?=$snippet['id']?>" target="_blank">
					<pre class="line-numbers"><code class="<?=$lang?>"><?=htmlspecialchars($snippet['code'])?></code></pre>
				</a>
			</div>
		<?php } ?>
	</div>
<?php
	}
?>

<?php
	include_once('../database/db_user.php');
	function draw_new_snippet() {
		$languages = getLanguages();
?>
	<div class="main-content flex-col-container center">
		<form action="../actions/post_snippet.php" enctype="multipart/form-data" method="post">
			<label for="title">Title</label>
			<input type="text" name="title">
			<br>
			<label for="description">Description</label>
			<input type="text" name="description">
			<br>
			<label for="language">Language</label>
			<select name="language">
				<?php foreach($languages as $lang) {
					echo '<option value="' . $lang['code'] . '">' . $lang['name'] . '</option>';
				} ?>
			</select>
			<br>
			<label for="snippet">File</label>
			<input type="file" name="snippet">
			<br>
			<input type="hidden" name="author" value="<?=$_SESSION['user']?>" />
			<input type="submit">
		</form>
	</div>
<?php
	}
?>

<?php
	function draw_footer() {
?>
		</body>
	</html>
<?php
	}
?>