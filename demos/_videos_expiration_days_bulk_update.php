<?php
/*
	This script will show you how you can update multiple videos in the same time

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. video_tokens
	4. expiration_days
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "video_tokens:", "expiration_days:"));

$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$result = $ziggeo->videos()->update_bulk(array(
	"tokens_or_keys" => $opts["video_tokens"],
	"expiration_days" => @$opts["expiration_days"] ? $opts["expiration_days"] : null
));

var_dump($result);

?>