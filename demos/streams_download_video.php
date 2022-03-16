<?php
/*
	This script will show you how to download a specific stream of a video

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

//see streams_get.php for more info
$video = $ziggeo->streams()->get($opts["video_token"], $opts["stream_token"]);

$file_name = $opts["video_token"]."_".$opts["stream_token"].".".$video["video_type"];

$file_content = $ziggeo->streams()->download_video($opts["video_token"], $opts["stream_token"]);

file_put_contents($file_name, $file_content);

?>