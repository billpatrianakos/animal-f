<?php
/**
 * new_post.php
 * Writes post content to the relevant files.
 * By Bill Patrianakos
 */

# Disable Magic Quotes (it messes up the output and we're already accepting input from a trusted source and escaping it ourselves)
if (get_magic_quotes_gpc()) {
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process)) {
        foreach ($val as $k => $v) {
            unset($process[$key][$k]);
            if (is_array($v)) {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            } else {
                $process[$key][stripslashes($k)] = stripslashes($v);
            }
        }
    }
    unset($process);
}

# Include the Markdown library
include_once "markdown.php";

# Gather input
$title 		= $_POST['title'];
$content 	= Markdown($_POST['content']);
$excerpt 	= substr($_POST['content'], 0, 250) . "...";
$date 		= "Posted on " . date("l, F d, Y");

$recent_posts_file 		= "../includes/recent_posts.php";
$blog_index_file 		= "../includes/blog_index.php";
$hp_recent_posts_file 	= "../includes/hp_recent_posts.php";

//$recent_posts_content = trim($title);
//$recent_posts_content = str_replace(" ", "-", $recent_posts_content);
$recent_posts_content = trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($title)), '-');

# Create a backup of the post
$backup_contents 	= $title . "\n\n" . $_POST['content'];
$backup_file 		= "../backups/$recent_posts_content.md";
file_put_contents($backup_file, $backup_contents);

# Write to recent_posts file
// Open the file to get existing content
$current = file_get_contents($recent_posts_file);
// Append a new person to the file
$new = "<li><a href='http://asapquotes.com/blog/" . mb_strtolower($recent_posts_content) . ".html'>$title</a></li>" . "\n" . $current;
// Write the contents back to the file
file_put_contents($recent_posts_file, $new);

# Write to blog_index file
// Open the file to get existing content
$current = file_get_contents($blog_index_file);
// Append a new person to the file
$new = "<div class='post-data'>
			<h2><a href='http://asapquotes.com/blog/" . mb_strtolower($recent_posts_content) . ".html'>$title</a></h2>
			<h3 class='post-date'>$date</h3>
			<p>$excerpt</p>
			<p><a class='readmore' href='http://asapquotes.com/blog/" . mb_strtolower($recent_posts_content) . ".html'>Read more</a></p>
		</div>" . "\n" . $current;
// Write the contents back to the file
file_put_contents($blog_index_file, $new);

# Write to the homepage recent posts file
// Open the file to get existing content
$current = file_get_contents($hp_recent_posts_file);
// Append a new person to the file
$new = "<li><h4><a class='hp-recent-link' href='http://asapquotes.com/blog/" . mb_strtolower($recent_posts_content) . ".html'>$title</a></h4><span class='hp-post-date'>$date</span></li>" . "\n" . $current;
// Write the contents back to the file
file_put_contents($hp_recent_posts_file, $new);

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
	<link rel="stylesheet" type="text/css" href="includes/blog.css" />
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
				<p class="post-date"><?php echo $date; ?></p>
				<div id="single-post" class="">
					<?php echo $content; ?>
				</div>
				<a href="http://asapquotes.com/blog">&larr; Back to the blog</a>
				<div id="post-comments">
					  <div id="disqus_thread"></div>
				        <script type="text/javascript">
				            var disqus_shortname = 'asapquotes';
				            (function() {
				                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
				                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
				                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
				            })();
				        </script>
				        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
				        <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
				</div>
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