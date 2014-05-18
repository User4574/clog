<?php
	require("settings.php");
	require("echo_article.php");
?>
<!DOCTYPE html>
<html>

<head>
	<title><?php echo $blogTitle; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo $blogRoot; ?>styles.css" />
	<?php include("sharescript.php"); ?>
	<?php
	if ($GAEnabled){
		include("ga.php");
	}
	?>
</head>

<body class='clog_body'>

<div class="clog_title">
<h1><?php echo $blogHead; ?></h1>
<a class="clog_toplink" href="<?php echo $blogRoot; ?>">Home</a>
<a class="clog_toplink" href="<?php echo $blogRoot; ?>archives.php">Archives</a>
<?php
if ($postmode == "show"){
	echo "<a class='clog_toplink' href='" . $blogRoot . "post.php'>Post</a>";
}
?>
</div>

<?php
	$start = 0;
	$show = $MaxArticlesPerPage;
	if(isset($_GET['start'])) $start = $_GET['start'];
	if(isset($_GET['show'])) $show = $_GET['show'];

	$lsin = file_get_contents(".lsout");
	$ls = explode("\n", $lsin);

	function hide($var) {
		return(!preg_match('/^\./', $var));
	}
	array_filter($ls, "hide");

	include("sharethiscustom.php");

	$limitedls = array_slice($ls, $start, $show);
	foreach($limitedls as $file) {
		if ($file === "") continue;
		article($file, $dodisqus = false);
	}

	echo "<div class='clog_title'>\n";
	$older = $start + $show;
	$newer = $start - $show;
	if ($older <= (count($ls) - 1)) echo "<a class='clog_toplink' href='{$blogRoot}?start=$older&show=$show'>&lt; Older</a>\n";
	if ($newer >= 0) echo "<a class='clog_toplink' href='{$blogRoot}?start=$newer&show=$show'>Newer &gt;</a>\n";
	echo "</div>\n";
?>
<p style='color:white;'>This website uses cookies. If you don't like this, please stop using this site.</p>
</body>

</html>
