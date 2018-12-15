<?php

include_once('utils.php');

function draw_full_snippet($snippet, $comments) { 
	$lang = 'language-' . $snippet['language'];
	$name = isset($snippet['name'])? $snippet['name']: $snippet['username'];
	$pic = getPicture($snippet['author']);
	?>
	<div class="full-card center">
		<div class="snippet-wrapper flex-col-container" data-id="<?=$snippet['id']?>">
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
						<h1>Comments</h1>
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
					<h2 class="expand-title"><span>+</span> Author</h2>
					<div class="author-wrapper">
						<div class="author-row">
							<a href="../pages/profile.php?id=<?=$snippet['author']?>">
								<span class="author-name"><?=$name?></span>
							</a>
							<a href="../pages/profile.php?id=<?=$snippet['author']?>">
								<img class="round-img" src="<?=$pic?>" alt="profile picture" />
							</a>
						</div>
						<span class="date-posted"><?=getTimeElapsed($snippet['date'])?></span>
					</div>
					<h2 class="expand-title"><span>+</span> Description</h2>
					<div class="description-wrapper">
						<h1>Description</h1>
						<p class="description"><?=$snippet['description']?></p>
					</div>
					<?php if ($_SESSION['user'] == $snippet['author']) { ?>
						<span class="delete-button"> Delete snippet </span>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

<?php } ?>

<?php
	function draw_new_snippet($languages) {
?>
	<div class="full-card center new-snippet-wrapper">
		<h1>Add new snippet</h1>
		<form action="#" enctype="multipart/form-data" method="post">
			<div class="row">
				<label class="required" for="title"><span>Title</span><span class="input-info"></span></label>
				<input type="text" name="title" id="title" placeholder="Give your awesome snippet a catchy title" maxlength="70">
			</div>
			<div class="row">
				<label for="description"><span>Description</span></label>
				<textarea name="description" id="description"
				placeholder="Write something about your snippet" maxlength="1000"></textarea>
			</div>
			<div class="row">
				<label class="required" for="language"><span>Language</span><span class="input-info"></span></label>
				<select name="language" id="language">
					<?php foreach($languages as $lang) { ?>
						<option value="<?=$lang['code']?>" <?=($lang['code']==='none')? 'selected="selected"': null?>><?=$lang['name']?></option>
					<?php } ?>
				</select>
			</div>
			<div class="row">
				<label class="required" for="file-input"><span>File</span><span class="input-info"></span></label>
				<div class="file-input-wrapper">
					<header>
						<div class="tabs">
							<button id="write-mode" class="active">Write</button>
							<button id="preview-mode">Preview</button>
						</div>
						<label for="file-upload"><i class="fas fa-upload"></i>  <span>Upload a file instead</span></label>
					</header>
					<textarea id="code-area" placeholder="Write or paste here!" rows="10" ></textarea>
					<pre id="preview-area" class="line-numbers"><code></code></pre>
				</div>
				<input type="file" name="file" id="file-upload">
			</div>
			<div class="row">
				<p class="input-info"></p>
				<input type="submit">
			</div>
		</form>
	</div>
<?php
	}
?>