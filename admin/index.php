<?php
if (isset($_GET['success']) && $_GET['success'] == 'true') {
	$success 	= "success";
	$view 		= $_GET['view'];
}
else {
	$success = "hidden";
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	 
	<title>ASAP Quotes Blogging Platform</title>
	<meta name="author" content="Bill Patrianakos" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" href="css/style.css" />
	<link href='http://fonts.googleapis.com/css?family=Puritan:400,700|Corben|Oxygen+Mono' rel='stylesheet' type='text/css'>
	<script src="js/libs/respond.min.js" type="text/javascript"></script>
	
	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!--[if gte IE 9]>
	<style type="text/css">
	.gradient { filter: none; }
	</style>
	<![endif]-->

</head>

<body>

	<header class="container">
		<section class="row">
			<article class="six">
				<img id="logo" src="img/logo.png" class="left">
				<h1>Animal F.</h1>
				<h6 id="subtitle">ASAP News in minimal, awesome, long-form format</h6>
			</article>
			<nav class="six last">
				<ul>
					<li><a href="index.php">New post</a></li>
					<li><a href="markdown.php">Help</a></li>
				</ul>
			</nav>
		</section>
	</header>
	<section id="main-container" class="container">
		<section id="first-row" class="row">
			<article class="two">
				<div class="sidebar_module">
					<h4>Options</h4>
					<p>
						Coming soon.
					</p>
				</div>
			</article>
			<article class="ten last">
				<div class="<?php echo $success; ?>">
					<p>
						<strong><i class="icon-heart-empty"></i> Success!</strong>
						<br />
						Your last post was successful! You can write a new one or visit it <a href="http://asapquotes.com/blog/<?php echo $view; ?>.html" target="_blank">here</a>.
					</p>
				</div>
				<h2>New post</h2>
				<p>
					<strong>Hint:</strong> To format your posts, use Markdown. If you don't know what that is, click the Help link at the top of this page
				</p>
				<div id="form">
					<form method="post" action="new_post.php">
						<label>Post Title</label>
						<br />
						<input type="text" name="title" placeholder="Plans for world domination..." />
						<br />
						<textarea id="content" name="content" placeholder="Once upon a time..."></textarea>
						<br /><br />
						<label>Post excerpt (Optional)</label>
						<br />
						<textarea id="excerpt" name="excerpt" placeholder="Only write in here if you want the post preview to be different than the first paragraph of the actual blog post"></textarea>
						<p>
							<small>Copy and paste a small portion of your post here or write an overview of your post. This will show just below the title of your post on the main page of posts.</small>
						</p>
						<button type="submit" class="gradient button">Post <i class="icon-save"></i></button>
					</form>
				</div>
			</article>
		</section>
	</section>
	<footer class="container">
		<section class="row">
			<article class="twelve">
				<p class="centered-text">
					&copy; Copyright 2012 Everybody | <strong>Animal F.</strong> is a Bill Patrianakos production. Enjoy. | Version 0.6
				</p>
			</article>
		</section>
	</footer>


	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/libs/jquery1.8.2.min.js">\x3C/script>')</script>
	<script src="js/plugins.js"></script>
	<script src="js/scripts.js"></script>


	<!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
    <![endif]--> 

</body>
</html>