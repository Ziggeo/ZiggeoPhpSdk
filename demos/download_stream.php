<?php
/*
	Usage:
	$>php download_stream.php --token YOUR_API_TOKEN --privatekey YOUR_PRIVATE_KEY --video ViDEO_TOKEN --stream STREAM_TOKEN
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "video:", "stream:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$video = $ziggeo->streams()->get($opts["video"], $opts["stream"]);

$file_name = $opts["video"]."_".$opts["stream"].".".$video->video_type;

$file_content = $ziggeo->streams()->download_video($opts["video"], $opts["stream"]) ;
file_put_contents($file_name, $file_content);

?>