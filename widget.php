<?php
	require("settings.php");
	require("echo_article.php");
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

	article($file, $dodisqus = false);

	if (!$inlinemode){
	echo"
	</body>

	</html>
	";
	}
?>