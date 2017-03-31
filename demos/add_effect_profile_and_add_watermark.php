<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

//$opts = getopt("", array("token:", "privatekey:", "title:", "key:"));

$opts = array(
	"token" => "50e380ee205d0d5e469de49038170463",
	"privatekey" => "b85eac069adacf51ceb1b9c696d166ca",
	"key" => "qweqwe",
	"title" => "New Test",
	"image_file" => "/home/pablo-i/2.jpg",
	"horizontal" => 0.5,
	"vertical" => 0.5,
	"scale" => 0.25
);

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