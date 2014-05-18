<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Clog ls Update</title>
</head>
<body>
<?php
require("settings.php");
$ls = `ls -1 {$blogPosts}/`;
$files = explode("\n", trim($ls));

$filenames = array();
$intvals = array();
$titles = array();

echo "<br>ls order...<br><br>";

foreach ($files as $file){
	$f = fopen("$blogPosts" . "$file", 'r');
	$thisName = trim(fgets($f)); 
	$titles[] = $thisName;
	$filenames[] = $file;
	$intvals[] = intval($file);
	echo "$blogPosts" . "$file - $thisName<br>";
}

echo "<br>New order...<br><br>";

rsort($intvals);

$newfilenames = array();
$newtitles = array();

foreach ($intvals as $val){
	$index = array_search($val, $filenames);
	$file = $filenames[$index];
	$thisName = $titles[$index];
	echo "$blogPosts" . "$file - $thisName<br>";
	$newfilenames[] = $file;
	$newtitles[] = 	$thisName;
}

echo "<br>Saving files...<br><br>";

$title = implode("\n", $newtitles);

$nameout = fopen(".nmout", "w");
fputs($nameout, $title);
fclose($nameout);

$filen = implode("\n", $newfilenames);

$lsout = fopen(".lsout", "w");
fputs($lsout, $filen);
fclose($lsout);

echo ".nmout and .lsout files generated<br><br> All done.";
?>	
</body>
</html>
