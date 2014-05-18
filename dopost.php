<?php
	require("settings.php");

	if (!isset($_POST['title']) || !isset($_POST['content'])) {
		header("location: {$blogRoot}post.php");
		exit(0);
	}

	$title = $_POST['title'];
	$file = time();
	$content = $_POST['content'];
	
	if (file_put_contents("{$blogPosts}$file", $title . "\n" . $content) == false){
		header("location: {$blogRoot}post.php?e=2");
		exit(0);			
	}
	
	
	function error3(){
		header("location: {$blogRoot}post.php?e=3");	
		die();
	}
	
$ls = `ls -1 {$blogPosts}/`;
$files = explode("\n", trim($ls));
$filenames = array();
$intvals = array();
$titles = array();
foreach ($files as $file){
	$f = fopen("$blogPosts" . "$file", 'r');
	$thisName = trim(fgets($f)); 
	$titles[] = $thisName;
	$filenames[] = $file;
	$intvals[] = intval($file);
}
rsort($intvals);
$newfilenames = array();
$newtitles = array();
foreach ($intvals as $val){
	$index = array_search($val, $filenames);
	$file = $filenames[$index];
	$thisName = $titles[$index];
	$newfilenames[] = $file;
	$newtitles[] = 	$thisName;
}
$title = implode("\n", $newtitles);
$nameout = fopen(".nmout", "w") or error3();
fputs($nameout, $title);
fclose($nameout);
$filen = implode("\n", $newfilenames);
$lsout = fopen(".lsout", "w") or error3();
fputs($lsout, $filen);
fclose($lsout);
	
	
//redirect
header("location: {$blogRoot}");
?>
