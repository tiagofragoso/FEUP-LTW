<?php
include_once('utils.php');
function draw_profile($user, $snippets, $following, $followers, $languages, $settings){ 
	$pic = getPicture($user['id']);
	?>
	<div class="full-card center flex-row-container">
			<div class="user-info flex-col-container">
				<img class="profile-pic" src="<?=$pic?>" />
				<h1><?=$user['name']?></h1>
				<div class="username-points flex-row-container flex-vert-center">
					<h2><?=$user['username']?></h2>
					<span><?=$user['points']?></span>
				</div>
				<?php if ($settings) { ?>
					<a class="profile-button-settings" href="settings.php"> Settings </a>
				<?php } else { ?>
					<div class="profile-button-follow-wrapper flex-row-container">
						<span class="profile-button-follow"> Follow </span>
						<span id="userId"><?=$user['id']?></span>
					</div>
				<?php } ?>
			</div>
		
		<div class="user-profile-wrapper flex-col-container">
			<div class="profile-top flex-row-container ">
				<div class="user-following flex-col-container">
					<div class="profile-section-title flex-row-container flex-vert-center">
						<h1>Following</h1>
						<h2><?=count($following)?></h2> 
					</div>
					<div class="user-following-wrapper grid4x2">
						<?php foreach (array_slice($following, 0, 8) as $f) { ?>
						<a href="profile.php?id=<?=$f['id']?>">
							<img class="mini-user-pic" src="<?=getPicture($f['id'])?>" /> 
						</a>
						<?php } ?>
					</div>
				</div>
				<div class="user-followers flex-col-container">
					<div class="profile-section-title flex-row-container  flex-vert-center">
						<h1>Followers</h1>
						<h2><?=count($followers)?></h2>
					</div>
					<div class="user-followers-wrapper grid4x2">
						<?php foreach (array_slice($followers, 0, 8) as $f) { ?>
							<a href="profile.php?id=<?=$f['id']?>">
							<img class="mini-user-pic" src="<?=getPicture($f['id'])?>" /> 
						</a>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="user-languages">
				<div class="profile-section-title flex-row-container  flex-vert-center">
					<h1>Languages</h1>
					<h2><?=count($languages)?></h2>
				</div>
				<div class="languages flex-row-container">
					<?php foreach ($languages as $language) { ?>
						<a href="../pages/channels.php?code=<?=$language['code']?>">
							<div class="language-wrapper">
								<?=$language['name']?>
							</div>
						</a>
					<?php } ?>
				</div>
			</div>
			<div class="user-snippets">
				<div class="profile-section-title flex-row-container  flex-vert-center">
					<h1>Snippets</h1>
					<h2><?=count($snippets)?></h2>
				</div>
				<div class="user-snippets-preview">
					<?php foreach ($snippets as $snippet) { ?>
						<div class="snippet-preview flex-row-container flex-space-between flex-vert-center">
							<div class="snippet-preview-content flex-row-container flex-space-between flex-vert-center" href="/pages/snippet.php?id=<?=$snippet['id']?>">
								<div class="card-title"><?=$snippet['title']?></div>
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
			</div>
			<div class="user-activity">
				<div class="profile-section-title flex-row-container  flex-vert-center">
					<h1>Activity</h1>
				</div>
				
			</div>
		</div>
	</div>

<?php } ?>

<?php
function draw_settings_profile() {
	$user = getUser($_SESSION['user']);
	$pic = getPicture($user['id']);
	?>
	<div class="main-content center flex-row-container">
		<div class="user-info flex-col-container">
			<img class="profile-pic" src="<?=$pic?>" />
			<h1><?=$user['name']?></h1>
			<h2><?=$user['username']?></h3>
			<label for="file-input">Change photo</label>
			<input type="file" id="file-input" accept="image/png, image/jpeg" />
		</div>
		<div class="user-settings flex-col-container">
			<h1>Settings</h1>
			<form action="#" method="post">
				<div class="row">
					<label for="name">Name</label>
					<input type="text" name="name" id="name" />
				</div>
				<div class="row">
					<label for="username">Username</label>
					<input type="text" name="username" id="username" required="required"/>
				</div>
				<div class="row">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" required="required" />
				</div>
				<input type="submit" name="submit" value="Update profile" />
			</form>
			<form action="#" method="post">
				<div class="row">
					<label for="old_password">Old password</label>
					<input type="password" name="old_password" id="old_password" required="required" />
				</div>
				<div class="row">
					<label for="new_password">New password</label>
					<input type="password" name="new_password" id="new_password" required="required" />
				</div>
				<input type="submit" name="submit-password" value="Update password" />
			</form>
		</div>
	</div>
<?php } ?>