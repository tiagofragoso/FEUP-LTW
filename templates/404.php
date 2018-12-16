<?php 
function draw_snippet(){?>
	<div class="main-content center">
		<h1 class="error-title">404: There's nothing to see here</h1>
		<div class="snippet-wrapper">
			<header id="page404" class="snippet-header flex-row-container flex-space-between flex-vert-center">
				<div class="rating-wrapper">
				</div>
				<h1 class="card-title">Setting up a 404 ErrorDocument</h1>
				<div class="language-wrapper">
				</div>
			</header>
			<div>
			<pre class="line-numbers"><code class="language-none">
1. Navigate to the document root of your website
                        
2. Open/Create the .htaccess file
                        
3. Add the following line ErrorDocument 404 /your/404/page/path

</code></pre>
			</div>
			<footer class="snippet-footer flex-row-container flex-space-between flex-vert-center">
				<div class="snippet-author-date flex-row-container flex-vert-center">
					<a class="author-name">SNIPZ</a>
				</div>
			</footer>
		</div>
	</div>
<?php }?>