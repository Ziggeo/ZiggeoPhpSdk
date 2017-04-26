<?php
/*
	Usage:
	$>php download_all_video.php --token YOUR_API_TOKEN --privatekey YOUR_PRIVATE_KEY
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$idx = $ziggeo->videos()->index();
foreach ($idx as $video) {
	$videoObject = $ziggeo->videos()->get($video->token);

	$file_extension = $videoObject->original_stream->video_type;
	$file_name = $videoObject->original_stream->video_token.".".$file_extension;

	echo "Downloading " .$file_name. "\n";


	$file_content = $ziggeo->videos()->download_video($videoObject->original_stream->video_token) ;
	file_put_contents($file_name, $file_content);
}

?>