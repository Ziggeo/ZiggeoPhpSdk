<?php
/*
	Usage:
	$>php download_all_video.php --token YOUR_API_TOKEN --privatekey YOUR_PRIVATE_KEY --video ViDEO_TOKEN
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "video:", "filename:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$video = $ziggeo->videos()->get($opts["video"]);

$file_extension = $video->original_stream->video_type;
$file_name = @$opts["filename"] ? $opts["filename"] : $video->original_stream->video_token.".".$file_extension;

$file_content = $ziggeo->videos()->download_video($video->original_stream->video_token) ;
file_put_contents($file_name, $file_content);

?>