<?php
/*
	This script will show you how you can download 50 videos from your account
	* Index has a limit of 50 by default, and up to 100. A slight change would be needed to download all videos.
	* check `_application_copy.php` and `_application_push.php` to see examples on how

	Parameters you need to pass:
	1. app_token
	2. private_key
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:"));

$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

//see videos_index.php
$idx = $ziggeo->videos()->index();

foreach ($idx as $video) {
	//see videos_get.php
	$videoObject = $ziggeo->videos()->get($video->token);

	$file_extension = $videoObject->original_stream->video_type;
	$file_name = $videoObject->original_stream->video_token.".".$file_extension;

	echo "Downloading " .$file_name. "\n";

	//see videos_download_video.php
	$file_content = $ziggeo->videos()->download_video($videoObject->original_stream->video_token) ;
	file_put_contents($file_name, $file_content);
}

?>