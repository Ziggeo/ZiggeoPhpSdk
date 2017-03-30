<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "title:", "key:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$effect = $ziggeo->effectProfiles()->create(array(
	"title" => $opts["title"],
	"key" => (!empty($opts["key"])) ? $opts["key"] : null
));