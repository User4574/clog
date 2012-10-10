<?php
	if (!isset($_GET['post'])) {
		header("location: $blogRoot");
		exit(0);
	}

	require("top.php");

	$file = $_GET['post'];
	echo "<div>\n";
	echo "<a class=\"title\" href=\"{$blogRoot}post/" . urlencode($file) . "\">$file <span id=\"perma\">[Permalink]</span></a>\n";

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
