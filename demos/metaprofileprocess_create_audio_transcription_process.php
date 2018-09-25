<?php
/*
	This script will show you how to create a meta profile and attach audio transcription process

	Info: https://ziggeo.com/features/audio-transcription

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. meta_title
	4. meta_key
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "meta_title:", "meta_key:"));

//We initiate our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$metaprofiles = $ziggeo->metaProfiles()->create(array(
	"title" => $opts["meta_title"],
	"key" => (!empty($opts["meta_key"])) ? $opts["meta_key"] : null
));

$ziggeo->metaProfileProcess()->create_audio_transcription_process($metaprofiles->token);

?>