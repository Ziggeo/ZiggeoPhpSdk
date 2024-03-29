<?php
/*
	This script will show you how to get details of a stream of specific video

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. video_token
	4. stream_token
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "video_token:", "stream_token:"));

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$result = $ziggeo->streams()->get($opts["video_token"], $opts["stream_token"]);

var_dump($result);

?>