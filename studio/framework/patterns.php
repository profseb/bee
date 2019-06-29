<?php

if ($solution_xml == "") {

	$xml_file = "$base_path/xml/$filename.xml";

	if (file_exists($xml_file)) {
		$xml = file_get_contents($xml_file);
	} else {

		$h = explode("var appOptions = ",$html);
		$h = explode("appOptions.locale",$h[1]);
		$h = preg_replace(array('/}};/i','/\\\u003c/i','/\\\u003e/i'),array('}}','&lt;','&gt;'),$h[0]);
		$json = json_decode($h);
		$xml = $json->level->solutionBlocks;
		file_put_contents($xml_file,html_entity_decode($xml));

	}

} else {
	$xml = $solution_xml;

}

if ($_GET["play"] == "1") {
	$autoplay = '<script type="text/javascript">var autorun = true;</script>';
} else {
	$autoplay = '<script type="text/javascript">var autorun = false;</script>';
}

$patterns = array();
$replacements = array();

//$patterns[] = '/{"ids/i';
$patterns[] = '/"nextLevelUrl":"\/s\//i';
$patterns[] = '/"redirect":"\/s\//i';
$patterns[] = '/http:\/\/studio\.code\.org\/s/i';
if ($_GET["play"] == "") {
	//$patterns[] = '/(<div class="header_level_container">)/i';
}
$patterns[] = '/<\/body>/i';
$patterns[] = '/application-(.*)\.css/i';
$patterns[] = '/code-studio-(.*)\.css/i';
$patterns[] = '/common-(.*)\.css/i';
$patterns[] = '/maze-(.*)\.css/i';
$patterns[] = '/application-(.*)\.js/i';
$patterns[] = '/webpack-runtime\.min-(.*)\.js/i';
$patterns[] = '/marked\.min-(.*)\.js/i';
$patterns[] = '/logo-(.*)\.png/i';
$patterns[] = '/essential\.min-(.*)\.js/i';
$patterns[] = '/common_locale-(.*)\.js/i';
$patterns[] = '/code-studio-common.min-(.*)\.js/i';
$patterns[] = '/code-studio\.min-(.*)\.js/i';
$patterns[] = '/show\.min-(.*)\.js/i';
$patterns[] = '/blockly-(.*)\.js/i';
$patterns[] = '/common\.min-(.*)\.js/i';
$patterns[] = '/maze\.min-(.*)\.js/i';
$patterns[] = '/header_progress\.min-(.*)\.js/i';
$patterns[] = '/header\.min-(.*)\.js/i';
$patterns[] = '/blockly_locale-(.*)\.js/i';
$patterns[] = '/maze_locale-(.*)\.js/i';
$patterns[] = '/(en_us)\/(.*)\.js/i';
$patterns[] = '/\/\/www\.google-analytics\.com\/analytics\.js/i';
$patterns[] = '/\/\/cdn\.optimizely\.com\/js\/(.*)\.js/i';

//$replacements[] = 'TROCADO';
$replacements[] = '"nextLevelUrl":"/studio/' . $game . "/";
$replacements[] = '"redirect":"/studio/' . $game . "/";
$replacements[] = $base_url . '/studio/'. $game;
if ($_GET["play"] == "") {
	//$replacements[] = '$1<button id="extractButton">Extrair XML</button><button id="myButton">Executar</button>';
}	
$replacements[] = '<div id="xmlWrapper">' . html_entity_decode($xml) . '</div>' . $autoplay . '<script type="text/javascript" src="/unpluggy.js?' . time() . '"></script></body>';
$replacements[] = 'application.css';
$replacements[] = 'code-studio.css';
$replacements[] = 'common.css';
$replacements[] = 'maze.css';
$replacements[] = 'application.js';
$replacements[] = 'webpack-runtime.min.js';
$replacements[] = 'marked.min.js';
$replacements[] = 'logo.png';
$replacements[] = 'essential.min.js';
$replacements[] = 'common_locale.js';
$replacements[] = 'code-studio-common.min.js';
$replacements[] = 'code-studio.min.js';
$replacements[] = 'show.min.js';
$replacements[] = 'blockly.js';
$replacements[] = 'common.min.js';
$replacements[] = 'maze.min.js';
$replacements[] = 'header_progress.min.js';
$replacements[] = 'header.min.js';
$replacements[] = 'blockly_locale.js';
$replacements[] = 'maze_locale.js';
$replacements[] = 'pt_br/$2.js';
$replacements[] = '/assets/analytics.js';
$replacements[] = '/assets/optimizely.js';