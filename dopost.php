<?php
	require("settings.php");

	if (!isset($_POST['title']) || !isset($_POST['content'])) {
		header("location: {$blogRoot}post.php");
		exit(0);
	}

	$file = $_POST['title'];
	$content = $_POST['content'];

	file_put_contents("{$blogPosts}$file", $content);

	header("location: {$blogRoot}");
?>
