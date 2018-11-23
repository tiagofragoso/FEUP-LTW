<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Page Title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
	<link rel="stylesheet" href="prism.css" />
</head>
<body>

	<form action="post_snippet.php" enctype="multipart/form-data" method="post">
		<label for="title">Title</label>
		<input type="text" name="title">
		<label for="description">Description</label>
		<input type="text" name="description">
		<label for="language">Language</label>
		<select name="language">
			<option value="css">CSS</option>
			<option value="javascript">JavaScript</option>
		</select>
		<label for="snippet">File</label>
		<input type="file" name="snippet">
		<input type="submit">
	</form>


	<?php
		$db = new PDO('sqlite:test.db');
		$stmt = $db->prepare('SELECT * FROM snippets');
  		$stmt->execute();	
		$snippets = $stmt->fetchAll();
		
		foreach ($snippets as $snippet) {
			$lang = 'language-' . $snippet['language']; ?>
			 <div class="snippet-wrapper">
				 <header class="toolbar">
					 <span class="title"><?=$snippet['title']?></span>
					 <span class="language"><?=$snippet['language']?></span>
				 </header>
				 <pre class="line-numbers"><code class="<?=$lang?>"><?=$snippet['code']?></code></pre>
			</div>
		<? } ?>
	<script src="prism.js"></script>
</body>
</html>