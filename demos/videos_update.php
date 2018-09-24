<?php
/*
	This script will show you how to approve the video through API call through the update call

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. video_token
	4. video_tags
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "video_token:", "video_tags:"));

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$ziggeo->videos()->update($opts["video_token"], array(
	"tags" => $opts['video_tags']
));

?>