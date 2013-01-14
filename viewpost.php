<?php
	if (!isset($_GET['post'])) {
		header("location: $blogRoot");
		exit(0);
	}
	require("settings.php");
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
	<meta name="twitter:title" content="<?php echo $getpost; ?>">
	<meta name="twitter:description" content="<?php echo preg_replace('/"/', '&quot;', substr($post, 0, 196)) . "..."; ?>">
</head>

<body>

<div id="title">
<h1><?php echo $blogHead; ?></h1>
<a class="toplink" href="<?php echo $blogRoot; ?>">Home</a>
<a class="toplink" href="<?php echo $blogRoot; ?>archives.php">Archives</a>
<a class="toplink" href="<?php echo $blogRoot; ?>post.php">Post</a>
</div>

<?php
	echo "<div>\n";
	echo "<a class=\"title\" href=\"{$blogRoot}post/" . urlencode($getpost) . "\">$getpost <span id=\"perma\">[Permalink]</span></a> ";
?>
<a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php echo "$blogTitle: {$getpost}"; ?>">[Tweet]</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<?php
	$stat = stat("{$blogPosts}$getpost");
	$date = date('d-m-Y H:i T', $stat['mtime']);
	echo "<span class=\"date\">$date</span>\n";
	echo "<br><br>\n";

	echo $post;
	echo "</div>\n</a>\n\n";
?>

</body>

</html>
