<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "title:", "key:", "image_file:", "horizontal:", "vertical:", "scale:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$effect = $ziggeo->effectProfiles()->create(array(
	"title" => $opts["title"],
	"key" => (!empty($opts["key"])) ? $opts["key"] : null
));

$watermarkOpts = array(
	"image_file" => $opts["image_file"],
	"horizontal" => $opts["horizontal"],
	"vertical" => $opts["vertical"],
	"scale" => $opts["scale"]
);

$watermark = $ziggeo->effectProfileProcess()->create_watermark_process($effect->token, $opts);