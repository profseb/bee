<?php


$opts = array(
			  'http'=>array(
			    'method'=>"GET",
			    'header'=>"accept-language: pt-BR,pt;q=0.9\r\n" .
			              "language_=pt-BR;\r\n"
			  )
			);

$context = stream_context_create($opts);

$filename = "course$course-stage$stage-puzzle$index";

if ($fetch_local) {
	$source = "../$game/source/$filename.html";	
	if (file_exists($source)) {echo file_get_contents($source, true, $context);exit;}
}

$base_path = "../$game";

$cache_file = "$base_path/cache/$filename.html";
$url = "https://studio.code.org/s/course$course/stage/$stage/puzzle/$index";



if (file_exists($cache_file) && !$force_remote) {
	$html = file_get_contents($url, true, $context);
} else {
	$html =  file_get_contents($url, true, $context);	
	file_put_contents($cache_file, $html);
}

require_once "patterns.php";

//$html = '';
$html = preg_replace($patterns, $replacements, $html);
//echo htmlentities($html);exit;

file_put_contents("$base_path/source/$filename.html", $html);	

echo $html;