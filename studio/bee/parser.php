<?php

$course = (empty($_GET["c"])) ? 1:$_GET["c"];
$stage = ($course == 1) ? 7:(($course == 2) ? 8:13);
$index = (empty($_GET["s"])) ? 1:$_GET["s"];


$fetch_local = true; 
$force_remote = false;

if ($fetch_local) {
	$filename = "source/$index.html";
	if (file_exists($filename)) {echo file_get_contents($filename);exit;}
}

$base_path = "codes";

$cache_file = "$base_path/$course/cache/$index.html";
$url = "https://studio.code.org/s/course$course/stage/$stage/puzzle/$index";

if (file_exists($cache_file) && !$force_remote) {
	$html = file_get_contents($cache_file);
} else {
	$html =  file_get_contents($url);	
	file_put_contents($cache_file, $html);
}

require_once "patterns.php";

//$html = '';
$html = preg_replace($patterns, $replacements, $html);
//echo htmlentities($html);exit;

file_put_contents("$base_path/$course/source/$index.html", $html);	

echo $html;