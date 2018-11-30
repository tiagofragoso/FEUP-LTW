<?php

	include_once('utils.php');
	function draw_header($title, $modules = array()) {
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
			<link rel="stylesheet" type="text/css" media="screen" href="/css/prism.css" />
			<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/solid.css" integrity="sha384-rdyFrfAIC05c5ph7BKz3l5NG5yEottvO/DQ0dCrwD8gzeQDjYBHNr1ucUpQuljos" crossorigin="anonymous">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/fontawesome.css" integrity="sha384-u5J7JghGz0qUrmEsWzBQkfvc8nK3fUT7DCaQzNQ+q4oEXhGSx+P2OqjWsfIRB8QT" crossorigin="anonymous">
			<script id="prism" src="/js/prism.js"></script>
			<?php foreach($modules as $module) { ?>
				<script type="module" src="/js/<?=$module?>.js"></script>
			<?php } ?>
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
									<a class="dropdown-button" href="/pages/profile.php?id=<?=$_SESSION['user']?>">
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
			$name = isset($snippet['name'])? $snippet['name']: $snippet['username'];
			$countComments = getSnippetCommentCount($snippet['id']);
			$lang = 'language-' . $snippet['language']; ?>
			 <div class="snippet-wrapper-feed">
			 	<header class="snippet-header flex-row-container flex-space-between flex-vert-center">
					<div class="rating-wrapper">
						<i class="fas fa-caret-up"></i>
						<span class="snippet-rating"><?=$snippet['points']?></span>
						<i class="fas fa-caret-down"></i>
					</div>
					<h1 class="card-title"><?=$snippet['title']?></h1>
					<div class="language-wrapper">
						<?=$snippet['languageName']?>
					</div>
				</header>
				 <a href="/pages/snippet.php?id=<?=$snippet['id']?>" target="_blank">
					<pre class="line-numbers"><code class="<?=$lang?>"><?=htmlspecialchars($snippet['code'])?></code></pre>
				</a>
				<footer class="snippet-footer flex-row-container flex-space-between flex-vert-center">
					<div class="snippet-author-date flex-row-container flex-vert-center">
						<span class="author-name"><?=$name?></span>
						<span class="date-posted"><?=getTimeElapsed($snippet['date'])?></span>
					</div>
						<span class="comments"><?=$countComments['count']?></span>
				</footer>
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
	<div class="full-card center new-snippet-wrapper">
		<h1>Add new snippet</h1>
		<form action="#" enctype="multipart/form-data" method="post">
			<div class="row">
				<label for="title">Title</label>
				<input type="text" name="title" id="title">
			</div>
			<div class="row">
				<label for="description">Description</label>
				<textarea name="description" id="description"
				placeholder="Write something about your snippet"></textarea>
			</div>
			<div class="row">
				<label for="language">Language</label>
				<select name="language" id="language">
					<?php foreach($languages as $lang) {
						echo '<option value="' . $lang['code'] . '">' . $lang['name'] . '</option>';
					} ?>
				</select>
			</div>
			<div class="row">
				<label for="file-input">File</label>
				<div class="file-input-wrapper">
					<header>
						<div class="tabs">
							<button id="write-mode" class="active">Write</button>
							<button id="preview-mode">Preview</button>
						</div>
						<label for="file-upload"><i class="fas fa-upload"></i>  Upload a file instead</label>
					</header>
					<textarea id="code-area" placeholder="Write or paste here!" rows="10"></textarea>
					<pre id="preview-area" class="line-numbers"><code></code></pre>
				</div>
				<input type="file" name="file" id="file-upload">
			</div>
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