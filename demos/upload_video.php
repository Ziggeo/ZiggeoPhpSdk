<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "file:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$ziggeo->videos()->create(array(
	"file" => $opts["file"]
));