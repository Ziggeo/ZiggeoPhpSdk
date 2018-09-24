<?php
/*
	This script will show you how you can download the video

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. video_token
	4. filename
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "video_token:", "filename:"));

$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$file_name = $opts["filename"];

$file_content = $ziggeo->videos()->download_video($opts["video_token"]) ;

file_put_contents($file_name, $file_content);

?>