<?php
include_once('utils.php');
function draw_profile($user, $snippets, $follows){ 
	$pic = getPicture($user['profilePic']);
	?>
	<div class="main-content">
		<div class="user-info">
			<div class="user-ident">
				<h1><?=$user['name']?></h1>
				<h2><?=$user['username']?></h2>
			</div>
			<img src="<?=$pic?>" />
			<span>Settings</span>
		</div>
	</div>


<?php } ?>