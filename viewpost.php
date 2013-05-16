<?php
	require("settings.php");
	if (!isset($_GET['post'])) {
		header("location: $blogRoot");
		exit(0);
	}
	$getpost = preg_replace('/\+/', ' ', $_GET['post']);
	$post = file_get_contents("{$blogPosts}$getpost");
	$post = preg_replace('/\n/', "<br>\n", $post);
?>

<!DOCTYPE html>
<html>

<head>
	<title><?php echo $blogTitle; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo $blogRoot; ?>styles.css" />
	<meta name="twitter:card" content="summary">
	<meta name="twitter:url" content="<?php echo "http://{$_SERVER['SERVER_NAME']}{$blogRoot}".$_GET['post']; ?>">
	<meta name="twitter:creator" content="<?php echo $twitterCreator; ?>">
	<meta name="twitter:title" content="<?php echo $getpost; ?>">
	<meta name="twitter:description" content="<?php echo preg_replace('/"/', '&quot;', substr($post, 0, 196)) . "..."; ?>">
</head>

<body class='clog_body'>

<div class='clog_title'>
<h1><?php echo $blogHead; ?></h1>
<a class="clog_toplink" href="<?php echo $blogRoot; ?>">Home</a>
<a class="clog_toplink" href="<?php echo $blogRoot; ?>archives.php">Archives</a>
<?php
if ($postmode == "show"){
	echo "<a class='clog_toplink' href='" . $blogRoot . "post.php'>Post</a>";
}
?>
</div>

<?php
	echo "<div class='clog_post_div'>\n";
	echo "<a class='clog_title' href=\"{$blogRoot}post/" . urlencode($getpost) . "\">$getpost <span class='clog_perma'>[Permalink]</span></a> ";
?>
<a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php echo "$blogTitle: {$getpost}"; ?>" data-url="http://<?php echo "{$_SERVER['SERVER_NAME']}{$_SERVER['REQUEST_URI']}"; ?>">[Tweet]</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<?php
	$stat = stat("{$blogPosts}$getpost");
	$date = date('d-m-Y H:i T', $stat['mtime']);
	echo "<span class='clog_date'>$date</span>\n";
	echo "<br><br>\n";

	echo $post;
	echo "</div>\n</a>\n\n";
?>

</body>

</html>
