<?php
	if (!isset($_GET['post'])) {
		header("location: $blogRoot");
		exit(0);
	}
	require("settings.php");
	require("functions.php");
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
	<meta name="twitter:description" content="<?php echo summarise($post); ?>">
</head>

<body>

<?php title(); ?>

<?php
  echo "<div>\n";
	echo "<a class=\"title\" href=\"{$blogRoot}post/" . urlencode($getpost) . "\">$getpost <span id=\"perma\">[Permalink]</span></a> ";
?>
<a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php echo "$blogTitle: {$getpost}"; ?>" data-url="http://<?php echo "{$_SERVER['SERVER_NAME']}{$_SERVER['REQUEST_URI']}"; ?>">[Tweet]</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<?php
	$stat = stat("{$blogPosts}$getpost");
	$date = date('d-m-Y H:i T', $stat['mtime']);
	echo "<span class=\"date\">$date</span>\n";
	echo "<br><br>\n";

	echo $post;
	echo "</div>\n</a>\n\n";
?>

<div id="disqus_thread">
	<script type="text/javascript">
		var disqus_shortname = 'user4574';

		(function() {
      var dsq = document.createElement('script');
      dsq.type = 'text/javascript';
      dsq.async = true;
			dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
			(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		})();
	</script>
	<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</div>

</body>

</html>
