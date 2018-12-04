<?php
include_once('utils.php');
function draw_profile($user, $snippets, $following, $followers, $languages, $settings){ 
	$pic = getPicture($user['profilePic']);
	?>
	<div class="full-card center flex-row-container">
			<div class="user-info flex-col-container">
				<img class="profile-pic" src="<?=$pic?>" />
				<h1><?=$user['name']?></h1>
				<h2><?=$user['username']?></h3>
				<?php if ($settings) { ?>
					<span class="profile-button-settings"> Settings </span>
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
							<img class="mini-user-pic" src="<?=getPicture($f['profilePic'])?>" /> 
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
							<img class="mini-user-pic" src="<?=getPicture($f['profilePic'])?>" /> 
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
						<div class="language-wrapper">
							<?=$language['name']?>
						</div>
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
							<div class="snippet-rat-date flex-row-container flex-space-between">
								<span class="snippet-rating"><?=$snippet['points']?></span>
							</div>
							<a class="card-title" href="/pages/snippet.php?id=<?=$snippet['id']?>"><?=$snippet['title']?></a>
							<div class="language-wrapper">
								<?=$snippet['languageName']?>
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