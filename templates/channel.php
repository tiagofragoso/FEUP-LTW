<?php
	function draw_channels() {
?>
		<div class="main-content center">
			<h1>Your languages</h1>
			<div class="card">
				<?php echo empty($_SESSION['user'])? 
				'<span class="channels-info">
				<a href="/pages/login.php">Login</a> to follow language channels
				</span>' : null
				?>
			</div>
			<h1>Explore other languages</h1>
			<div class="card">
			</div>
		</div>
<?php	
	}
?>