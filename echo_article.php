
 
<?php

require("settings.php");

function article($number, $dodisqus = false){
	global $urlstyle, $blogPosts, $blogRoot;
	global $DisqusEnabled, $sharethis, $Author;
	$post = file_get_contents("{$blogPosts}$number");
	$title = strtok($post, "\n");
	$post = preg_replace('/^.+\n/', '', $post);

	echo "<div itemscope itemtype='http://schema.org/Article' class='clog_post_div'>\n";
	
	
	$url = "";
	if ($urlstyle == 'ugly'){
		$url = "{$blogRoot}viewpost.php?post=" . urlencode($number);
	}
	if ($urlstyle == 'fancy'){
		$url = "{$blogRoot}post/" . urlencode($number);
	}	
	echo "<a class='clog_title' href='{$url}'> <span itemprop='name'>$title</span> <span class='clog_perma'>[Permalink]</span></a>\n";

	$date = date('d-m-Y H:i T', $number);
	echo "<span itemprop='datePublished' content='" . date('c', $number) . "' class='clog_date'>$date</span>\n";
	echo "<br><br>\n";

	echo "<span itemprop='articleSection' content='technology'></span>";
	echo "<span itemprop='articleSection' content='electronics'></span>";
	
	echo "<span itemprop='articleBody'>";
	echo $post;
	echo "</span>";
	echo "By <span itemprop='author'>$Author</span>.";
	
	echo "<br><br>\n";
	
	if ($sharethis or $DisqusEnabled){
		echo "<p style='background-color:black;height:2px;'></p>";
	}
	
	include("sharethis.php");
	
	if ($DisqusEnabled){
		if ($dodisqus){
			echo "<a id='comments'></a>";
			include("disquscode.php");
			echo "<span itemprop='discussionUrl' content='{$url}#comments'></span>\n";
		}
		else{
			echo "<p><span itemprop='discussionUrl' content='{$url}#comments'><a href='{$url}#comments'>Leave or view comments</a></span></p>\n";	
		}
	}
	
	
	echo "</div>\n</a>\n\n";
}
?>
  