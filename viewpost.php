<?php
	require("settings.php");
	require("echo_article.php");
	if (!isset($_GET['post'])) {
		header("location: $blogRoot");
		exit(0);
	}
	$getpost = $_GET['post'];
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
	article($getpost, $dodisqus = true);
?>

</body>

</html>
