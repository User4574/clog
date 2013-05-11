<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Clog ls Update</title>
</head>
<body>
<?php
require("settings.php");
$ls = `ls -1t {$blogPosts}/`;
$lsout = fopen(".lsout", "w");
fputs($lsout, $ls);
fclose($lsout);
echo ".lsout file generated"
?>	
</body>
</html>
