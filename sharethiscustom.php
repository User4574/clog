<?php
function shareButtons($url, $title){
echo"
<span class='st_googleplus' st_url='$url' st_title='$title' displayText='Google +'></span>
<span class='st_facebook' st_url='$url' st_title='$title' displayText='Facebook'></span>
<span class='st_twitter' st_url='$url' st_title='$title' displayText='Tweet'></span>
<span class='st_fblike' st_url='$url' st_title='$title' displayText='Facebook Like'></span>";
}
?>