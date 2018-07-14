<?php
/*
	Usage:
	$>php download_video.php --token YOUR_API_TOKEN --privatekey YOUR_PRIVATE_KEY --video VIDEO_TOKEN --filename FILE_NAME
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "video:", "filename:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$file_name = @$opts["filename"];

if (!@$file_name) {
    $video = $ziggeo->videos()->get($opts["video"]);

    $file_extension = $video->original_stream->video_type;
    $file_name = $video->original_stream->video_token . "." . $file_extension;
}

$file_content = $ziggeo->videos()->download_video($opts["video"]) ;
file_put_contents($file_name, $file_content);

?>