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
$lsout = fopen(".lsout", "w");
fputs($lsout, $ls);
fclose($lsout);
echo ".lsout file generated<br>";
$files = explode("\n", trim($ls));
$names = array();
foreach ($files as $file){
	//echo "$blogPosts" . "$file<br>";
	$f = fopen("$blogPosts" . "$file", 'r');
	$names[] = trim(fgets($f));
}
$name=implode("\n", $names);
$nameout = fopen(".nmout", "w");
fputs($nameout, $name);
fclose($nameout);
echo ".nmout file generated<br> All done.";
?>	
</body>
</html>
