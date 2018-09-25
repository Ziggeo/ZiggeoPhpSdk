<?php
/*
	This script shows you how the update_bulk works, allowing you to update several videos in the same time

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. video_tokens
	4. tags
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "video_tokens:", "tags:"));

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$result = $ziggeo->videos()->update_bulk(array(
	"tokens_or_keys" => $opts["video_tokens"],
	"tags" => isset($opts["tags"]) ? $opts["tags"] : null
));

var_dump($result);

?>