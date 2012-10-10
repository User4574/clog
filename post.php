<?php
	require("top.php");
?>
<div>
<form method="post" action="<?php echo $blogRoot; ?>dopost.php">
<input name="title" size="50">
<input type="submit" value="Post" />
<textarea rows="20" cols="93" name="content"></textarea>
</form>
</div>

</body>

</html>
