<?php
/*
	This script will show you how you can create the video with custom image, utilizing the streams methods.

	Parameters you need to pass:
	1. app_token - app token
	2. private_key - private key
	3. path_image - path to image file
	4. path_video - path to video file

*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt('', array('app_token:', 'private_key:', 'path_image:', 'path_video:'));

//We initialize our SDK
$ziggeo = new Ziggeo($opts['app_token'], $opts['private_key']);

// We create empty video object
$video_data = $ziggeo->videos()->create(array());

// Now we need to create empty stream object
$stream_data = $ziggeo->streams()->create($video_data['token'], array());

// Just here to make it easier for us
$video_token = $video_data['token'];
$stream_token = $stream_data['token'];

// We attach the image of our choosing
$ziggeo->streams()->attach_image($video_token, $stream_token, array('file' => $opts['path_image']));

// Now we attach the video
$ziggeo->streams()->attach_video($video_token, $stream_token, array('file' => $opts['path_video']));

// Video is now being processed.

?>