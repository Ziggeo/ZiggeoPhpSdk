<?php
/*
	This script will show you how to download a specific stream of a video

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. video_token
	4. video_stream
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "video_token:", "video_stream:"));

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

//see streams_get.php for more info
$video = $ziggeo->streams()->get($opts["video_token"], $opts["video_stream"]);

$file_name = $opts["video_token"]."_".$opts["video_stream"].".png";

$file_content = $ziggeo->streams()->download_image($opts["video_token"], $opts["video_stream"]);

file_put_contents($file_name, $file_content);

?>