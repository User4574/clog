<?php
	require("settings.php");

	if (!isset($_POST['title']) || !isset($_POST['content'])) {
		header("location: {$blogRoot}post.php");
		exit(0);
	}

	$file = $_POST['title'];
	$content = $_POST['content'];
	$nameissafe = preg_match('/^[a-z0-9][a-z0-9 ]*$/i', $file);

	if ($nameissafe){
		file_put_contents("{$blogPosts}$file", $content);
	}
	else{
		header("location: {$blogRoot}post.php?e=1");
		exit(0);
	}
	
	//update the ls list
	$ls = `ls -1t {$blogPosts}/`;
	$lsout = fopen(".lsout", "w");
	fputs($lsout, $ls);
	fclose($lsout);
	
	//redirect
	header("location: {$blogRoot}");
?>
