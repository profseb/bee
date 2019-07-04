<?php

$base_url = "http://mycode.org";

$fetch_local = false; 
$force_remote = false;

if ($_GET["solution"] != "") {

	$solution = explode("-",$_GET["solution"]);
	array_pop($solution);

	$xml = new SimpleXMLElement("<xml></xml>");
	
	$block = $xml->addChild('block');
	$block->addAttribute('type', 'when_run');
	$block->addAttribute('deletable', 'false');
	$block->addAttribute('movable', 'false');
	$next = $block->addChild("next");

	$blocks = array("N"=>"maze_moveNorth","S"=>"maze_moveSouth","L"=>"maze_moveEast","O"=>"maze_moveWest","G"=>"maze_nectar","M"=>"maze_honey");

	foreach($solution as $key=>$item) {
		$next = $next->addChild("block");
		$next->addAttribute("type",$blocks[$item]);
		if ($key < count($solution) - 1) {
			$next = $next->addChild("next");
		}
	}
	
	$solution_xml =  explode("\n",$xml->asXML());
	array_pop($solution_xml);
	array_shift($solution_xml);
	$solution_xml = implode("", $solution_xml);
	$solution_xml = str_replace("/>","></block>",$solution_xml);
		
	$fetch_local = false;
		
}


$course = (empty($_GET["c"])) ? 1:$_GET["c"];
$stage = (empty($_GET["s"])) ? $default_stage:$_GET["s"];
$index = (empty($_GET["p"])) ? 1:$_GET["p"];

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
//echo "<pre>";
//var_dump($html);exit;

file_put_contents("$base_path/source/$filename.html", $html);	

echo $html;