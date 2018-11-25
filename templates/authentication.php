<?php
	function draw_login() {
?>
	<div class="screen-wrapper">
		<div class="auth-form-wrapper">
			<?php include("../includes/logo.php") ?>
			<form action="../actions/action_login.php" method="POST" autocomplete="on">
				<input type="text" name="username" placeholder="username" maxlength="15" required="required">
				<input type="password" name="password" placeholder="password" required="required">
				<input type="submit" name="submit" value="LOGIN">
			</form>
		</div>
	</div>

<?php } ?>

<?php
	function draw_signup() {
?>
	<div class="screen-wrapper">
		<div class="auth-form-wrapper">
			<?php include("../includes/logo.php") ?>
			<form action="../actions/action_signup.php" method="POST">
				<input type="email" name="email" placeholder="e-mail" required="required">
				<input type="text" name="username" placeholder="username" maxlength="15" required="required">
				<input type="password" name="password" placeholder="password" required="required">
				<input type="submit" name="submit" value="SIGNUP">
			</form>
		</div>
	</div>
<?php } ?>