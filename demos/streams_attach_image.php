<?php
/*
	This script will show you how to download a specific stream of a video

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. video_token
	4. stream_token
	5. filename
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "video_token:", "stream_token:", "filename:"));

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$arguments = array(
	'file' => $opts["filename"]
);

$result = $ziggeo->streams()->attach_image($opts["video_token"], $opts["stream_token"], $arguments);

var_dump($result);

?>