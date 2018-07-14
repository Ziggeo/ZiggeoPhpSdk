<?php
/*
	Usage:
	$>php upload_video_stream.php --token YOUR_API_TOKEN --privatekey YOUR_PRIVATE_KEY --video VIDEO_TOKEN --filename FILE_NAME
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "video:", "filename:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$ziggeo->streams()->create($opts["video"], array(
    "file" => $opts["filename"]
));

?>