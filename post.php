<?php
	require("settings.php");
?>
<!DOCTYPE html>
<html>

<head>
	<title><?php echo $blogTitle; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo $blogRoot; ?>styles.css" />
</head>

<body>

<div id="title">
<h1><?php echo $blogHead; ?></h1>
<a class="toplink" href="<?php echo $blogRoot; ?>">Home</a>
<a class="toplink" href="<?php echo $blogRoot; ?>archives.php">Archives</a>
<a class="toplink" href="<?php echo $blogRoot; ?>post.php">Post</a>
</div>

<div>
<form method="post" action="<?php echo $blogRoot; ?>dopost.php">
<input name="title" size="50">
<input type="submit" value="Post" />
<textarea rows="20" cols="93" name="content"></textarea>
</form>
</div>

</body>

</html>
