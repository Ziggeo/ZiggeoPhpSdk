<?php
/*
	This script will show you how you can get details about a multiple videos in the same time

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. video_tokens
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "video_tokens:"));

$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$result = $ziggeo->videos()->get_bulk(array("tokens_or_keys" => $opts["video_tokens"]));

var_dump($result);

?>