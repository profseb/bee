<?php

$filename = "course$course-stage$stage-puzzle$index";

if ($fetch_local) {
	$source = "../$game/source/$filename.html";	
	if (file_exists($source)) {echo file_get_contents($source);exit;}
}

$base_path = "../$game";

$cache_file = "$base_path/cache/$filename.html";
$url = "https://studio.code.org/s/course$course/stage/$stage/puzzle/$index";

if (file_exists($cache_file) && !$force_remote) {
	$html = file_get_contents($cache_file);
} else {
	$html =  file_get_contents($url);	
	file_put_contents($cache_file, $html);
}

require_once "patterns.php";

$html = preg_replace($patterns, $replacements, $html);

file_put_contents("$base_path/source/$filename.html", $html);	

echo $html;