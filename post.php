<?php
	require("settings.php");
?>
<!DOCTYPE html>
<html>

<head>
	<title><?php echo $blogTitle; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo $blogRoot; ?>styles.css" />
	<?php
		if (($WYSIWYG=='miniMCE')
		||($WYSIWYG=='fullMCE')){
			$buttons = "";
			if($WYSIWYG == 'miniMCE'){
				$buttons = "selector: 'textarea',
				plugins: [
					'advlist autolink lists link image charmap print preview anchor',
					'searchreplace visualblocks code fullscreen',
					'insertdatetime media table contextmenu paste'
				],
				toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'";
			}
			if($WYSIWYG == 'fullMCE'){
				$buttons = "selector: 'textarea',
				theme: 'modern',
				plugins: [
					'advlist autolink lists link image charmap print preview hr anchor pagebreak',
					'searchreplace wordcount visualblocks visualchars code fullscreen',
					'insertdatetime media nonbreaking save table contextmenu directionality',
					'emoticons template paste'
				],
				toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
				toolbar2: 'print preview media | forecolor backcolor emoticons',
				image_advtab: true,
				templates: [
					{title: 'Test template 1', content: 'Test 1'},
					{title: 'Test template 2', content: 'Test 2'}
				],";
			}
		
			echo "
			<script type='text/javascript' src='$blogRoot" . "tinymce/js/tinymce/tinymce.min.js'></script>
			<script type='text/javascript'>
			tinymce.init({
				$buttons
			});
			</script>";
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

<div class='clog_post_div'>
<form method="post" action="<?php echo $blogRoot; ?>dopost.php">
<?php 
if (isset($_GET['e'])) {
	switch ($_GET['e']){
		case 1: echo "<p class='clog_error'>Error!<br>File name not allowed.</p>"; break;
		case 2: echo "<p class='clog_error'>Error!<br>Couldn't write to post directory. Please check that post directory exists and that you have permission to write to it.</p>";break;
		case 3: echo "<p class='clog_error'>Error!<br>Couldn't generate post listing files (.lsout and .mnout) please make sure you have permission to write to the blog directory.</p>";break;		
	}
}?>
<input name="title" size="50">
<input type="submit" value="Post" />
<textarea rows="20" cols="93" name="content"></textarea>
</form>
</div>

</body>

</html>
