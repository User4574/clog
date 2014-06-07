<?php
  require("settings.php");
  require("functions.php");
  header("Content-Type: application/atom+xml");

  echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n\n";
  echo "<feed xmlns=\"http://www.w3.org/2005/Atom\">\n";
  echo "\t<title>$blogTitle</title>\n";
  echo "\t<subtitle>$blogSubTitle</subtitle>\n";
  echo "\t<link href=\"http://{$_SERVER['SERVER_NAME']}{$blogRoot}feed\" rel=\"self\"/>\n";
  echo "\t<link href=\"http://{$_SERVER['SERVER_NAME']}{$blogRoot}\"/>\n";
  echo "\t<id>tag:{$_SERVER['SERVER_NAME']}," . date("Y-m-d") . ":$blogRoot</id>\n";
  echo "\t<updated>" . date(DATE_ATOM) . "</updated>\n\n";

	$ls = explode("\n", `ls -1t {$blogPosts}/`);
	foreach($ls as $file) {
		if (preg_match('/^\./', $file)) continue;
    if ($file === "") continue;

    $plusfile = preg_replace('/ /', '+', $file);
    $dashfile = preg_replace('/ /', '-', $file);
		$stat = stat("{$blogPosts}$file");
		$date = date(DATE_ATOM, $stat['mtime']);
    $post = file_get_contents("{$blogPosts}$file");
    $post = preg_replace('/\r?\n/', "<br>\n", $post);

    echo "\t<entry>\n";
    echo "\t\t<title>$file</title>\n";
    echo "\t\t<link href=\"http://{$_SERVER['SERVER_NAME']}{$blogRoot}post/{$plusfile}\" />\n";
    echo "\t\t<id>tag:{$_SERVER['SERVER_NAME']}," . date("Y-m-d") . ":{$blogRoot}{$dashfile}</id>\n";
    echo "\t\t<updated>$date</updated>\n";
    echo "\t\t<summary type=\"html\"><![CDATA[";
    echo summarise($post); 
    echo "]]></summary>\n";
    echo "\t\t<content type=\"html\"><![CDATA[";
    echo $post;
    echo "]]></content>\n";
    echo "\t\t<author>\n";
    echo "\t\t\t<name>$rssAuthorName</name>\n";
    if (isset($rssAuthorEmail)) echo "\t\t\t<email>$rssAuthorEmail</email>\n";
    echo "\t\t</author>\n";
    echo "\t</entry>\n";
	}

  echo "</feed>";
?>
