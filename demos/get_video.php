<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "video:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

var_dump($ziggeo->videos()->get($opts["video"]));
