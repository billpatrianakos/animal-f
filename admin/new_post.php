<?php
/**
 * new_post.php
 * Writes post content to the relevant files.
 * By Bill Patrianakos
 */

# Include the Markdown library
include_once "markdown.php";

# Gather input
$title 		= $_POST['title'];
$content 	= Markdown($_POST['content']);
$excerpt 	= $_POST['excerpt'];

$recent_posts_file 	= "../includes/recent_posts.php";
$blog_index_file 	= "../includes/blog_index.php";

# Write to recent_posts file
$recent_posts_content = trim($title);
$recent_posts_content = str_replace(" ", "-", $recent_posts_content);

// Open the file to get existing content
$current = file_get_contents($recent_posts_file);
// Append a new person to the file
$current .= "<li><a href='http://asapquotes.com/blog/" . mb_strtolower($recent_posts_content) . ".html'>$title</a></li>" . "\n";
// Write the contents back to the file
file_put_contents($recent_posts_file, $current);

# Write to blog_index file
// Open the file to get existing content
$current = file_get_contents($blog_index_file);
// Append a new person to the file
$current .= "<div class='post-data'><h1><a href='http://asapquotes.com/blog/" . mb_strtolower($recent_posts_content) . ".html'>$title</a></h1><p>$excerpt</p><p><a href='http://asapquotes.com/blog/" . mb_strtolower($recent_posts_content) . ".html'>Read more</a></p></div>" . "\n";
// Write the contents back to the file
file_put_contents($blog_index_file, $current);

# Begin building the new post page
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><?php echo $title; ?></title>
	<meta name="keywords" content="insurance lead whitepaper, insurance whitepapers, insurance pdfs, insurance documents" />
	<meta name="description" content="<?php echo $excerpt; ?>" />
	
	<?php include("../../includes/header_init.php"); ?>
	
</head>

<body>
	<div id="wrapper">
		<?php include("../../includes/header.php"); ?>
		
		<div class="header_spacer"></div>
		
		<div id="wrapper_inner">
			<div class="left_column">
				<ul id="recent-posts">
					<?php include("../includes/recent_posts.php"); ?>
				</ul>
			
			</div>
			
			<div class="right_column">
					<h1><span></span><?php echo $title; ?></h1>
					<p>Keep up with the latest industry news, tips, and more</p>
					<div id="single-post" class="">
						<?php echo $content; ?>
					</div>
					<a href="http://asapquotes.com/blog">&larr; Back to the blog</a>

			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<?php include("../../includes/footer.php"); ?>
		
	</div>
</body>
</html>

<?php
$new_post 	= ob_get_contents();
ob_end_flush();
$file 		= "../" . mb_strtolower($recent_posts_content) . ".html";
file_put_contents($file, $new_post);
header("Location: index.php?success=true&view=" . mb_strtolower($recent_posts_content));
?>