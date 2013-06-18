<?php
	require("settings.php");
	if (!isset($_GET['post'])) {
		header("location: $blogRoot");
		exit(0);
	}
	$getpost = preg_replace('/\+/', ' ', $_GET['post']);
	$post = file_get_contents("{$blogPosts}$getpost");
	$title = strtok($post, "\n");
	$post = preg_replace('/^.+\n/', '', $post);
	$post = preg_replace('/\n/', "<br>\n", $post);
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

<div class='clog_title'>
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
	echo "<div class='clog_post_div'>\n";
	if ($urlstyle == 'ugly'){
			echo "<a class='clog_title' href='{$blogRoot}viewpost.php?post=" . urlencode($getpost) . "'>$title <span class='clog_perma'>[Permalink]</span></a>\n";
	}
	if ($urlstyle == 'fancy'){
		echo "<a class='clog_title' href='{$blogRoot}post/" . urlencode($getpost) . "'>$title <span class='clog_perma'>[Permalink]</span></a>\n";
	}

	include("sharethis.php");

	$date = date('d-m-Y H:i T', $getpost);
	echo "<span class='clog_date'>$date</span>\n";
	echo "<br><br>\n";

	echo $post;
	echo "</div>\n</a>\n\n";
?>

</body>

</html>
