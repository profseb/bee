<?php

$game = "birds";

$fetch_local = true; 
$force_remote = false;

$course = (empty($_GET["c"])) ? 1:$_GET["c"];
$stage = (empty($_GET["s"])) ? 4:$_GET["s"];
$index = (empty($_GET["p"])) ? 1:$_GET["p"];

require_once "../framework/parser.php";