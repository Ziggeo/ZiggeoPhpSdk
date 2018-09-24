<?php
/*
	This script will show you how you can get details about a single video

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. video_token
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "video_token:"));

$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$result = $ziggeo->videos()->get($opts["video_token"]);

var_dump($result);

?>