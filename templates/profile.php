<?php
include_once('utils.php');
function draw_profile($user, $snippets, $following, $followers, $languages, $settings, $comments){ 
	$pic = getPicture($user['id']);
	?>
	<div data-id="<?=$user['id']?>" class="full-card center flex-row-container profile-wrapper">
		<div class="user-info flex-col-container">
			<img id="profile-pic" src="<?=$pic?>" />
			<div class="user-details flex-col-container">
				<h1><?=$user['name']?></h1>
				<h2><?=$user['username']?><span><?=$user['points']?></span></h2>
			</div>
				<?=$settings? 
				'<a class="profile-button settings" href="settings.php">Settings</a>' : 
				'<span class="profile-button follow">Follow</span>'?>
		</div>
		<div class="profile-content-wrapper flex-col-container">
			<section class="profile-top flex-row-container">
				<div class="user-following flex-col-container">
					<header class=" flex-row-container flex-vert-center">
						<h1>Following</h1>
						<h2><?=count($following)?></h2> 
					</header>
					<div class="user-following-wrapper grid4x2">
						<?php foreach (array_slice($following, 0, 8) as $f) { ?>
						<a href="profile.php?id=<?=$f['id']?>">
							<img class="mini-user-pic" src="<?=getPicture($f['id'])?>" /> 
						</a>
						<?php } ?>
					</div>
				</div>
				<div class="user-followers flex-col-container">
					<header class="flex-row-container flex-vert-center">
						<h1>Followers</h1>
						<h2><?=count($followers)?></h2>
						</header>
					<div class="user-followers-wrapper grid4x2">
						<?php foreach (array_slice($followers, 0, 8) as $f) { ?>
							<a href="profile.php?id=<?=$f['id']?>">
							<img class="mini-user-pic" src="<?=getPicture($f['id'])?>" /> 
						</a>
						<?php } ?>
					</div>
				</div>
			</section>
			<section class="user-languages">
				<header class="flex-row-container flex-vert-center">
					<h1>Languages</h1>
					<h2><?=count($languages)?></h2>
				</header>
				<div class="languages flex-row-container">
					<?php foreach ($languages as $language) { ?>
						<a href="../pages/channels.php?code=<?=$language['code']?>">
							<div class="language-wrapper">
								<?=$language['name']?>
							</div>
						</a>
					<?php } ?>
				</div>
			</section>
			<section class="user-snippets">
				<header class="flex-row-container flex-vert-center">
					<h1>Snippets</h1>
					<h2><?=count($snippets)?></h2>
				</header>
				<div class="user-snippets-preview">
					<?php foreach ($snippets as $snippet) { ?>
						<div class="snippet-preview flex-row-container flex-space-between flex-vert-center">
							<div class="snippet-preview-content flex-row-container flex-space-between flex-vert-center">
								<a class="card-title" href="../pages/snippet.php?id=<?=$snippet['id']?>"><?=$snippet['title']?></a>
								<a href="../pages/channels.php?code=<?=$snippet['language']?>">
									<div class="language-wrapper">
										<?=$snippet['languageName']?>
									</div>
								</a>
							</div>
							<div class="hover-content-points">
								<span><?=$snippet['points']?></span>
							</div>
						</div>
					<?php } ?>
				</div>
			</section>
			<section class="user-activity">
				<header class=" flex-row-container  flex-vert-center">
					<h1>Activity</h1>
				</header>
				<div class="user-comments">
						<?php 
						if (count($comments) == 0) { ?>
							<span class="no-activity">No activity</span>
						<?php } else {
							foreach($comments as $comment) { ?>
								<div class="user-comment flex-col-container">
									<span class="user">
										<span class="comment-username"><?=$user['username']?></span>
										commented on
										<a href="../pages/snippet.php?id=<?=$comment['snippet']?>"><?=htmlspecialchars($comment['title'])?></a>:
									</span>
									<span class="user-comment-text">
										<?=htmlspecialchars($comment['text'])?>
									</span>
								</div>
						<?php }
						} ?>
				</div>
			</section>
		</div>
	</div>

<?php } ?>

<?php
function draw_settings_profile() {
	$user = getUser($_SESSION['user']);
	$pic = getPicture($user['id']);
	?>
	<div class="full-card center flex-row-container profile-wrapper">
		<div class="user-info flex-col-container">
			<img id="profile-pic" src="<?=$pic?>" />
			<span class="input-info"></span>
			<div class="user-details flex-col-container">
				<h1><?=$user['name']?></h1>
				<h2><?=$user['username']?><span><?=$user['points']?></span></h2>
			</div>
			<label class="profile-button" for="file-input">Change photo</label>
			<input type="file" id="file-input" accept="image/png, image/jpeg" />
		</div>
		<div class="user-settings flex-col-container">
			<h1>Settings</h1>
			<form>
				<div class="row">
					<label for="name"><span>Name</span><span class="input-info"></span></label>
					<input type="text" name="name" id="name" />
				</div>
				<div class="row">
					<label for="username"><span>Username</span><span class="input-info"></span></label>
					<input type="text" name="username" id="username" required="required"/>
				</div>
				<div class="row">
					<label for="email"><span>Email</span><span class="input-info"></span></label>
					<input type="email" name="email" id="email" required="required" />
				</div>
				<div class="flex-row-container flex-vert-center">
					<input type="submit" name="submit" value="Update profile" />
					<p class="input-info"></p>
				</div>
			</form>
			<form>
				<div class="row">
					<label for="old_password"><span>Old password</span><span class="input-info"></span></label>
					<input type="password" name="old_password" id="old_password" required="required" />
				</div>
				<div class="row">
					<label for="new_password"><span>New password</span><span class="input-info"></span></label>
					<input type="password" name="new_password" id="new_password" required="required" />
				</div>
				<div class="flex-row-container flex-vert-center"> 
					<input type="submit" name="submit-password" value="Update password" />
					<p class="input-info"></p>
				</div>
			</form>
			<div class="delete-profile">
				<span class="delete-button">Delete account</span>
			</div>
		</div>
	</div>
<?php } ?>