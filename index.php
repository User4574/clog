<?php
	require("settings.php");
?>
<!DOCTYPE html>
<html>

<head>
	<title><?php echo $blogTitle; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo $blogRoot; ?>styles.css" />
</head>

<body class='clog_body'>

<div class="clog_title">
<h1><?php echo $blogHead; ?></h1>
<a class="clog_toplink" href="<?php echo $blogRoot; ?>">Home</a>
<a class="clog_toplink" href="<?php echo $blogRoot; ?>archives.php">Archives</a>
<a class="clog_toplink" href="<?php echo $blogRoot; ?>post.php">Post</a>
</div>

<?php
	$start = 0;
	$show = 5;
	if(isset($_GET['start'])) $start = $_GET['start'];
	if(isset($_GET['show'])) $show = $_GET['show'];

	$lsin = file_get_contents(".lsout");
	$ls = explode("\n", $lsin);

	function hide($var) {
		return(!preg_match('/^\./', $var));
	}
	array_filter($ls, "hide");

	$limitedls = array_slice($ls, $start, $show);
	foreach($limitedls as $file) {
		if ($file === "") continue;

		echo "<a id='$file'>";
		echo "<div class='clog_post_div'>\n";
		if ($urlstyle == 'ugly'){
			echo "<a class='clog_title' href='{$blogRoot}viewpost.php?post=" . urlencode($file) . "'>$file <span class='clog_perma'>[Permalink]</span></a>\n";
		}
		if ($urlstyle == 'fancy'){
			echo "<a class='clog_title' href='{$blogRoot}post/" . urlencode($file) . "'>$file <span class='clog_perma'>[Permalink]</span></a>\n";
		}

		$stat = stat("{$blogPosts}$file");
		$date = date('d-m-Y H:i T', $stat['mtime']);
		echo "<span class='clog_date'>$date</span>\n";
		echo "<br><br>\n";

		$post = file_get_contents("{$blogPosts}$file");
		$post = preg_replace('/\n/', "<br>\n", $post);
		echo $post;
		echo "</div>\n</a>\n\n";
	}

	echo "<div class='clog_title'>\n";
	$older = $start + $show;
	$newer = $start - $show;
	if ($newer >= 0) echo "<a class='clog_toplink' href='{$blogRoot}?start=$newer&show=$show'>Newer</a>\n";
	if ($older <= (count($ls) - 2)) echo "<a class='clog_toplink' href='{$blogRoot}?start=$older&show=$show'>Older</a>\n";
	echo "</div>\n";
?>
</body>

</html>
