<?php
	require("settings.php");
	$inlinemode = isset($_GET['inlinemode']);

	if (!$inlinemode){
	echo"
<!DOCTYPE html>
<html>

<head>
	<title><?php echo $blogTitle; ?></title>
	<link rel='stylesheet' type='text/css' href='<?php echo $blogRoot; ?>styles.css' />
</head>
<body class='clog_body'>";
}

	$file = "";
	if (!isset($_GET['post'])) {
		$ls = explode("\n", `ls -1t {$blogPosts}/`);
		foreach($ls as $entry) {
			if (preg_match('/^\./', $entry)) continue;
			if ($entry === "") continue;
			$file = $entry;
			break;
		}
	} else
		$file = preg_replace('/\+/', ' ', $_GET['post']);

	echo "<div class='clog_post_div'>\n";
	echo "<a class='clog_title' href=\"{$blogRoot}post/" . urlencode($file) . "\">$file <span class='clog_perma'>[Permalink]</span></a> ";
?>

<a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php echo "$blogTitle: {$file}"; ?>" data-url="http://<?php echo "{$_SERVER['SERVER_NAME']}{$_SERVER['REQUEST_URI']}"; ?>">[Tweet]</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<?php
	$stat = stat("{$blogPosts}$file");
	$date = date('d-m-Y H:i T', $stat['mtime']);
	echo "<span class='clog_date'>$date</span>\n";
	echo "<br><br>\n";

	$post = file_get_contents("{$blogPosts}$file");
	$post = preg_replace('/\n/', "<br>\n", $post);
	echo $post;
	echo "</div>\n</a>\n\n";

	if (!$inlinemode){
	echo"
	</body>

	</html>
	";
	}
?>