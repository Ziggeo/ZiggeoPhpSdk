<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

echo ($ziggeo->videos()->count()->count . "\n");