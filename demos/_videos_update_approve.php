<?php
/*
	This script will show you how to approve the video through API call through the update call

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. video_token
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "video_token:"));

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

//see videos_update.php for more
$ziggeo->videos()->update($opts["video_token"], array(
	"approved" => TRUE
));

?>