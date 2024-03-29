<?php
/*
	This script will show you how to create an effect profile through API and to attach a watermark (logo) process.

	info: https://ziggeo.com/features/watermarks

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. effect_profile_token
	5. file_path
	6. horizontal_position
	7. vertical_position
	8. video_scale
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "effect_profile_token:", "file_path:", "horizontal_position:", "vertical_position:", "video_scale:"));

$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

//Set up the watermark object
$arguments = array(
	"file" => $opts["file_path"],
	"horizontal_position" => $opts["horizontal_position"], //horizontal placement of the watermark in the video
	"vertical_position" => $opts["vertical_position"], //vertical placement of the watermark in the video
	"video_scale" => $opts["video_scale"] //amount of scaling done on the image before added to the video
);

$effect_profile_token = $opts["effect_profile_token"];

//Assign a new watermark process to our new effect profile
$watermark = $ziggeo->effectProfileProcess()->create_watermark_process($effect_profile_token, $arguments);

var_dump($watermark);

?>