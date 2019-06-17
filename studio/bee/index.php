<?php

$game = "bee";

$fetch_local = false; 
$force_remote = true;

$course = (empty($_GET["c"])) ? 1:$_GET["c"];
$stage = (empty($_GET["s"])) ? 7:$_GET["s"];
$index = (empty($_GET["p"])) ? 1:$_GET["p"];

require_once "../framework/parser.php";