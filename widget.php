<?php
	require("settings.php");
	$inlinemode = isset($_GET['inlinemode']);

	if (!$inlinemode){
	echo"
<!DOCTYPE html>
<html>

<head>
	<title>$blogTitle</title>
	<link rel='stylesheet' type='text/css' href='$blogRoot/styles.css' />";
	include("sharescript.php");
echo"</head>
<body class='clog_body'>";
}

	$file = "";
	if (!isset($_GET['post'])) {
		$lsin = file_get_contents(".lsout");
		$ls = explode("\n", $lsin);
		foreach($ls as $entry) {
			if (preg_match('/^\./', $entry)) continue;
			if ($entry === "") continue;
			$file = $entry;
			break;
		}
	} else
		$file = preg_replace('/\+/', ' ', $_GET['post']);

	$post = file_get_contents("{$blogPosts}$file");
	$title = strtok($post, "\n");
	$post = preg_replace('/^.+\n/', '', $post);
	$post = preg_replace('/\n/', "<br>\n", $post);

	echo "<div class='clog_post_div_widget'>\n";
	echo "<a class='clog_title' href=\"{$blogRoot}viewpost.php?post=" . urlencode($file) . "\">$title <span class='clog_perma'>[Permalink]</span></a> ";

	include("sharethis.php");

	$date = date('d-m-Y H:i T', $file);
	echo "<span class='clog_date'>$date</span>\n";
	echo "<br><br>\n";

	
	echo $post;
	echo "</div>\n</a>\n\n";

	if (!$inlinemode){
	echo"
	</body>

	</html>
	";
	}
?>