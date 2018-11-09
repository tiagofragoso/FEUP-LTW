<?php
	function draw_header($user) {
?>
		<nav>
			<?php include("../includes/logo.php") ?>
			<div class="search">
				<!-- search bar -->
			</div>
			<?php if (isset($user)) { ?>
				<span>new snippet</span>
				<span>pic bro</span>
			<?php } else { ?>
				<a href="../pages/login.php">Login</a>
			<?php } ?>
		</nav>
<?php
	}
?>