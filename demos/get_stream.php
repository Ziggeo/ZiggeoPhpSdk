<?php
/*
	Usage:
	$>php get_stream.php --token YOUR_API_TOKEN --privatekey YOUR_PRIVATE_KEY --video ViDEO_TOKEN --stream STREAM_TOKEN
*/

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "video:", "stream:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

var_dump($ziggeo->streams()->get($opts["video"], $opts["stream"]));
