<?php
	include_once('../includes/session.php');
	include_once('../templates/utils.php');
	function draw_header($title, $modules = array()) {
?>
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title><?=$title?></title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta name="theme-color" content="#74B2B7">
			<link rel="icon" href="../assets/public/snipz_blue.png" type="image/png" sizes="16x16">
			<link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
			<link rel="stylesheet" type="text/css" media="screen" href="../css/prism.css" />
			<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/solid.css" integrity="sha384-rdyFrfAIC05c5ph7BKz3l5NG5yEottvO/DQ0dCrwD8gzeQDjYBHNr1ucUpQuljos" crossorigin="anonymous">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/fontawesome.css" integrity="sha384-u5J7JghGz0qUrmEsWzBQkfvc8nK3fUT7DCaQzNQ+q4oEXhGSx+P2OqjWsfIRB8QT" crossorigin="anonymous">
			<script id="prism" src="../js/prism.js"></script>
			<script type="module" src="../js/nav.js"></script>
			<?php foreach($modules as $module) { ?>
				<script type="module" src="../js/<?=$module?>.js"></script>
			<?php } ?>
		</head>
		<body>
<?php
	}
	
	function draw_nav() {
?>
		<nav>
			<a href="../pages/feed.php"><?php include("../includes/logo.php") ?></a>
			<div class="search">
				<i class="fas fa-search"></i>
				<form action="../pages/search.php">
					<input type="text" name="query" placeholder="Looking for something?" size="22">
					<button type="submit"><i class="fas fa-search"></i></button>
				</form>
				<ul class="search-results">
				</ul>
			</div>
			<div class="menu">
				<i class="fas fa-bars"></i>
				<ul class="nav-items">
						<li><a href="../pages/feed.php">Feed</a></li>
						<li><a href="../pages/channels.php">Channels</a></li>
				</ul>
				<ul class="menu-right">
					<?php if (isset($_SESSION['user'])) { 
						$pic = getPicture($_SESSION['user']);
						?>
						<li><a href="../pages/new.php"><i class="fas fa-plus"></i> SNIP</a></li>
						<li class="dropdown">
							<a class="dropdown-button" href="../pages/profile.php?id=<?=$_SESSION['user']?>">
								<img src="<?=$pic?>"/>
							</a>
							<div class="dropdown-content">
								<a href="../pages/profile.php?id=<?=$_SESSION['user']?>">Your profile</a>
								<a href="../pages/settings.php">Settings</a>
								<a href="../actions/action_logout.php">Logout</a>
							</div>
						</li>
						<li><i class="fas fa-caret-down"></i></li>
					<?php } else { ?>
						<li><a href="../pages/login.php">Login</a></li>
					<?php } ?>
				</ul>	
			</div>
		</nav>
<?php }

	function draw_feed($snippets, $mode, $sort) { ?>
	<div class="main-content center">
		<header class="feed-header">
			<h1><?=$mode === 'feed'? 'Feed': 'All snippets'?></h1>
			<form method="GET" action="../pages/feed.php">
				<input type="radio" id="feed" name="mode" value="feed" <?=$mode === 'feed'? 'checked' : null?>>
				<label for="feed">Feed</label>
				<input type="radio" id="all" name="mode" value="all" <?=$mode === 'all'? 'checked' : null?>>
				<label for="all">All</label>
				<select name="sort">
					<option value="latest" <?=$sort === 'latest'? 'selected' : null?>>Latest</option>
					<option value="oldest" <?=$sort === 'oldest'? 'selected' : null?>>Oldest</option>
					<option value="best" <?=$sort === 'best'? 'selected' : null?>>Best</option>
				</select>
				<input type="submit" value="GO">
			</form>
		</header>
		<?php 
		if (empty($snippets)){
			echo '<span class="channels-info">
				Your feed is empty. Try following some <a href="../pages/channels.php">channels</a>.
				<br>
				Or check our lastest <a href="../pages/feed.php?mode=all">snippets</a>.
				</span>';
		} else foreach ($snippets as $snippet) { 
			$name = isset($snippet['name'])? $snippet['name']: $snippet['username'];
			$countComments = getSnippetCommentCount($snippet['id']);
			$lang = 'language-' . $snippet['language']; ?>
			 <div class="snippet-wrapper-feed" data-id="<?=$snippet['id']?>">
			 	<header class="snippet-header flex-row-container flex-space-between flex-vert-center">
					<div class="rating-wrapper">
						<i class="fas fa-caret-up"></i>
						<span class="snippet-rating"><?=$snippet['points']?></span>
						<i class="fas fa-caret-down"></i>
					</div>
					<a href="../pages/snippet.php?id=<?=$snippet['id']?>"><h1 class="card-title"><?=$snippet['title']?></h1></a>
					<a href="../pages/channels.php?code=<?=$snippet['language']?>">
						<div class="language-wrapper">
							<?=$snippet['languageName']?>
						</div>
					</a>
				</header>
				 <div onclick="window.location.href ='../pages/snippet.php?id=<?=$snippet['id']?>'">
				 	<pre class="line-numbers"><code class="<?=$lang?>"><?=htmlspecialchars($snippet['code'])?></code></pre>
				 	<div class="snippet-overlay">Click to view the full snippet</div>
				</div>
				<footer class="snippet-footer flex-row-container flex-space-between flex-vert-center">
					<div class="snippet-author-date flex-row-container flex-vert-center">
						<a href="../pages/profile.php?id=<?=$snippet['author']?>" class="author-name"><?=$name?></a>
						<span class="date-posted"><?=getTimeElapsed($snippet['date'])?></span>
					</div>
						<span class="comments"><?=$countComments['count']?></span>
				</footer>
			</div>
		<?php }
		?>
	</div>
<?php
	}
	function draw_footer() {
?>
		</body>
	</html>
<?php
	}