<?php
function draw_full_snippet($snippet, $comments) { 
	$lang = 'language-' . $snippet['language'];
	$name = isset($snippet['name'])? $snippet['name']: $snippet['username'];
	$pic = isset($snippet['profilePic'])? 'data:image/jpeg;base64,'.base64_encode( $snippet['profilePic'] ):
			'../assets/profile-placeholder.png';
	?>
	<div class="full-card center flex-col-container">
		<h1 class="card-title center"><?=$snippet['title']?></h1>
		<div class="flex-row-container">
			<div class="snippet-left-wrapper">
				<pre class="line-numbers"><code class="<?=$lang?>"><?=htmlspecialchars($snippet['code'])?></code></pre>
			</div>
			<div class="info-wrapper flex-col-container">
				<div class="author-wrapper">
					<span class="author-name"><?=$name?></span>
					<img class="round-img" src="<?=$pic?>" alt="profile picture" />
				</div>
			</div>
		</div>
		
	</div>


<?php } ?>



<!-- <div class="main-content center">
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
	</div> -->