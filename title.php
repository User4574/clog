<?php
  require("settings.php");
?>
<div id="title">
<h1><?php echo $blogTitle; ?></h1>
<h2><?php echo $blogSubTitle; ?></h2>
<a class="toplink" href="<?php echo $blogRoot; ?>">Home</a>
<a class="toplink" href="<?php echo $blogRoot; ?>archives.php">Archives</a>
<a class="toplink" href="<?php echo $blogRoot; ?>feed">Feed</a>
<a class="toplink" href="<?php echo $blogRoot; ?>post.php">Post</a>
</div>
