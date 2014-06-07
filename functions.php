<?php

function summarise($post) {
  $post = preg_replace('/(\r?\n|\t)/', " ", $post);
  $post = preg_replace('/"/', "&quot;", $post);
  $post = preg_replace('/<.*?>/', " ", $post);
  return substr($post, 0, 196) . "...";
}

function title() {
  require("title.php");
}

?>
