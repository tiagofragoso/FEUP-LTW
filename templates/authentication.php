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
					<div class="input-field-wrapper">
						<input type="text" name="email" placeholder="email">
						<p class="input-info"> </p>
					</div>
					<div class="input-field-wrapper">
						<input type="text" name="username" placeholder="username" maxlength="25">
						<p class="input-info"> </p>
					</div>
					<div class="input-field-wrapper">
						<input type="password" name="password" placeholder="password">
						<p class="input-info"> </p>
					</div>
					<div class="input-field-wrapper">
						<input type="password" name="repPass" placeholder="repeat password">
						<p class="input-info"> </p>
					</div>
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
