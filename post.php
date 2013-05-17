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
<?php if (isset($_GET['e'])) {echo "Error! File name not allowed.<br>";}?>
<input name="title" size="50">
<input type="submit" value="Post" />
<textarea rows="20" cols="93" name="content"></textarea>
</form>
</div>

</body>

</html>
