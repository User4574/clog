<?php
	if (!isset($_GET['post'])) {
		header("location: $blogRoot");
		exit(0);
	}

	require("top.php");

	$file = $_GET['post'];
	echo "<div>\n";
	echo "<a class=\"title\" href=\"{$blogRoot}post/" . urlencode($file) . "\">$file <span id=\"perma\">[Permalink]</span></a> ";
?>
<a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php echo "$blogTitle: {$_GET['post']} {$_SERVER['SERVER_NAME']}{$_SERVER['REQUEST_URI']}"; ?>">[Tweet]</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<?php
	$stat = stat("{$blogPosts}$file");
	$date = date('d-m-Y H:i T', $stat['mtime']);
	echo "<span class=\"date\">$date</span>\n";
	echo "<br><br>\n";

	$post = file_get_contents("{$blogPosts}$file");
	$post = preg_replace('/\n/', "<br>\n", $post);
	echo $post;
	echo "</div>\n</a>\n\n";
?>

</body>

</html>
