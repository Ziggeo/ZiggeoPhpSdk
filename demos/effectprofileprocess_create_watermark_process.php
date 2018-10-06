<?php
/*
	This script will show you how to create an effect profile through API and to attach a watermark (logo) process.

	info: https://ziggeo.com/features/watermarks

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. effect_title
	4. effect_key (optional)
	5. file_path
	6. horizontal_position
	7. vertical_position
	8. video_scale
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "effect_title:", "effect_key:", "file_path:", "horizontal_position:", "vertical_position:", "video_scale:"));

$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

//Create a new effect profile
$effect = $ziggeo->effectProfiles()->create(array(
	"title" => $opts["effect_title"],
	"key" => (!empty($opts["effect_key"])) ? $opts["effect_key"] : null
));

//Set up the watermark object
$watermarkOpts = array(
	"file" => $opts["file_path"],
	"horizontal_position" => $opts["horizontal_position"], //horizontal placement of the watermark in the video
	"vertical_position" => $opts["vertical_position"], //vertical placement of the watermark in the video
	"video_scale" => $opts["video_scale"] //amount of scaling done on the image before added to the video
);

//Assign a new watermark process to our new effect profile
$watermark = $ziggeo->effectProfileProcess()->create_watermark_process($effect->token, $opts);

var_dump($watermark);

?>