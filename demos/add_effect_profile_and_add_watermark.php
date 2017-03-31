<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "title:", "key:", "file:", "horizontal:", "vertical:", "scale:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

//Create a new effect profile

$effect = $ziggeo->effectProfiles()->create(array(
	"title" => $opts["title"],
	"key" => (!empty($opts["key"])) ? $opts["key"] : null
));

$watermarkOpts = array(
	"file" => $opts["file"],
	"horizontal" => $opts["horizontal"],
	"vertical" => $opts["vertical"],
	"scale" => $opts["scale"]
);

//Assign a new watermark process to it
$watermark = $ziggeo->effectProfileProcess()->create_watermark_process($effect->token, $opts);