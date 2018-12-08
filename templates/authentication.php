<?php
	function draw_login() {
?>
	<div class="screen-wrapper">
			<?php include("../includes/logo.php") ?>
			<div class="auth-form-wrapper">
				<header>
					<span>LOGIN</span>
					<div class="toggle">
						<button></button>
					</div>
					<span>SIGNUP</span>
				</header>
				<form id="auth" action="#" method="POST" autocomplete="on">
					<input type="text" name="username" placeholder="username" maxlength="25" required="required">
					<input type="password" name="password" placeholder="password" required="required">
				</form>
				<footer>
					<input form="auth" type="submit" name="submit" value="LOGIN">
				</footer>
			</div>
			<footer>
				code snippets made simple
			</footer>
	</div>

<?php } ?>
