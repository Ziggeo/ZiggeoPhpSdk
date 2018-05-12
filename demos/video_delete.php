<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "video:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$ziggeo->videos()->delete($opts["video"]);