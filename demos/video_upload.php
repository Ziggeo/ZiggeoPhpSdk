<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "file:", "key:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$ziggeo->videos()->create(array(
	"file" => $opts["file"],
    "key" => $opts["key"]
));
