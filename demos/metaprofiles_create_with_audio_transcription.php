<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "title:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$metaprofiles = $ziggeo->metaProfiles()->create(array(
	"title" => $opts["title"]
));

$ziggeo->metaProfileProcess()->create_audio_transcription_process($metaprofiles->token, array("nsfw_action"=>"reject"));