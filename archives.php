<?php
	require("top.php");

	$ls = explode("\n", `ls -1t {$blogPosts}/`);
	foreach($ls as $file) {
		if (preg_match('/^\./', $file)) continue;
		if ($file === "") continue;

		echo "<a id=\"$file\">";
		echo "<div>\n";
		echo "<a class=\"title\" href=\"{$blogRoot}post/" . urlencode($file) . "\">$file</a>\n";

		$stat = stat("{$blogPosts}$file");
		$date = date('d-m-Y H:i T', $stat['mtime']);
		echo "<span class=\"date\">$date</span>\n";
		echo "</div>\n</a>\n\n";
	}
?>

</body>

</html>
