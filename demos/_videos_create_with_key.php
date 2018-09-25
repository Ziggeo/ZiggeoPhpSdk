<?php
/*
	This script will show you how you can create a video by uploading a file and set it up with a key
	* keys must be unique accross your application

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. filepath
	4. video_key
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "filepath:", "video_key:"));

$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$ziggeo->videos()->create(array(
	"file" => $opts["filepath"],
    "key" => $opts["video_key"]
));

?>