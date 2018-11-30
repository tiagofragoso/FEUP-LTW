<?php
include_once('utils.php');
function draw_profile($user, $snippets, $following, $followers, $languages, $settings){ 
	$pic = getPicture($user['profilePic']);
	?>
	<div class="full-card center flex-row-container ">
			<div class="user-info flex-col-container">
				<img class="profile-pic" src="<?=$pic?>" />
				<h1><?=$user['name']?></h1>
				<h2><?=$user['username']?></h3>
				<?php if ($settings) { ?>
					<span class="profile-button-settings"> Settings </span>
				<?php } else { ?>
					<span class="profile-button-follow"> Follow </span>
				<?php } ?>
			</div>
		
		<div class="user-profile-wrapper flex-col-container">
			<div class="profile-top flex-row-container ">
				<div class="user-following">
					<div class="profile-section-title flex-row-container flex-vert-center">
						<h1>Following</h1>
						<h2><?=count($following)?></h2> 
					</div>
				</div>
				<div class="user-followers">
					<div class="profile-section-title flex-row-container  flex-vert-center">
						<h1>Followers</h1>
						<h2><?=count($followers)?></h2>
					</div>
				</div>
			</div>
			<div class="user-languages">
				<div class="profile-section-title flex-row-container  flex-vert-center">
					<h1>Languages</h1>
					<h2><?=count($languages)?></h2>
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
		</div>
	</div>


<?php } ?>