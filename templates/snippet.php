<?php

include_once('utils.php');

function draw_full_snippet($snippet, $comments) { 
	$lang = 'language-' . $snippet['language'];
	$name = isset($snippet['name'])? $snippet['name']: $snippet['username'];
	$pic = getPicture($snippet['author']);
	?>
	<div class="full-card center flex-col-container">
		<header class="snippet-header flex-row-container flex-space-between flex-vert-center">
			<div class="rating-wrapper">
				<span id="snippetId"><?=$snippet['id']?></span>
				<i class="fas fa-caret-up"></i>
				<span class="snippet-rating"><?=$snippet['points']?></span>
				<i class="fas fa-caret-down"></i>
			</div>
			<h1 class="card-title"><?=$snippet['title']?></h1>
			<a href="../pages/channels.php?code=<?=$snippet['language']?>">
				<div class="language-wrapper">
					<?=$snippet['languageName']?>
				</div>
			</a>
		</header>
		<div class="card-content flex-row-container">
			<div class="snippet-left-wrapper">
				<pre class="line-numbers"><code class="<?=$lang?>"><?=htmlspecialchars($snippet['code'])?></code></pre>
				<div class="comments-wrapper">
					<?=draw_subtitle('Comments')?>
					<div id="new-comment" class="comment-wrapper">
						<form action="#" method="post">
							<input type="hidden" name="snippet" value="<?=$snippet['id']?>"/>
							<textarea name="text" rows="3" required="required" placeholder="Write something about this snippet"></textarea>
							<input type="submit" value="Send">
						</form>
					</div>
				</div>
			</div>
			<div class="info-wrapper flex-col-container">
				<div class="author-wrapper">
					<a href="../pages/profile.php?id=<?=$snippet['author']?>">
						<span class="author-name"><?=$name?></span>
					</a>
					<a href="../pages/profile.php?id=<?=$snippet['author']?>">
						<img class="round-img" src="<?=$pic?>" alt="profile picture" />
					</a>
				</div>
				<span class="date-posted"><?=getTimeElapsed($snippet['date'])?></span>
				<div class="description-wrapper">
					<?=draw_subtitle("Description")?>
					<p class="description"><?=$snippet['description']?></p>
				</div>
			</div>
		</div>
		
	</div>


<?php } ?>