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
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/solid.css" integrity="sha384-rdyFrfAIC05c5ph7BKz3l5NG5yEottvO/DQ0dCrwD8gzeQDjYBHNr1ucUpQuljos" crossorigin="anonymous">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/fontawesome.css" integrity="sha384-u5J7JghGz0qUrmEsWzBQkfvc8nK3fUT7DCaQzNQ+q4oEXhGSx+P2OqjWsfIRB8QT" crossorigin="anonymous">
			<script src="/prism.js"></script>
		</head>
		<body>
<?php
	}
?>

<?php
	include_once('../includes/session.php');
	include_once('utils.php');
	function draw_nav() {
?>
		<nav>
			<div class="nav-wrapper">
				<a href="/pages/feed.php"><?php include("../includes/logo.php") ?></a>
				<div class="navbar">
					<div class="search">
						<form action="#">
							<input type="text" name="search" placeholder="Looking for something?" size="22">
							<button type="submit"><i class="fas fa-search"></i></button>
						</form>
					</div>
					<div class="menu">
						<ul class="nav-items">
								<li><a href="/pages/feed.php">Feed</a></li>
								<li><a href="/pages/channels.php">Channels</a></li>
						</ul>
						<ul class="menu-right">
							<?php if (isset($_SESSION['user'])) { 
								$pic = getPicture($_SESSION['picture']);
								?>
								<li><a href="../pages/new.php"><i class="fas fa-plus"></i> SNIP</a></li>
								<li class="dropdown">
									<a class="dropdown-button" href="/pages/profile">
										<img src="<?=$pic?>"/>
									</a>
									<div class="dropdown-content">
										<a>username</a>
										<a>log out</a>
									</div>
								</li>
								<li><a href="../actions/action_logout.php"><i class="fas fa-sign-out-alt"></i></a></li>
							<?php } else { ?>
								<li><a href="../pages/login.php"><i class="fas fa-sign-in-alt"></i></a></li>
							<?php } ?>
						</ul>	
						
					</div>
					
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
		<form class="row" action="../actions/post_snippet.php" enctype="multipart/form-data" method="post">
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
			<label for="file-input">File</label>
			<input type="file" name="snippet" id="file-input">
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

<?php
	function draw_subtitle($title) { ?>
		<div class="subtitle-wrapper">
			<span class="subtitle"><?=$title?></span>
			<div class="separator"></div>
		</div>
	<?php } ?>