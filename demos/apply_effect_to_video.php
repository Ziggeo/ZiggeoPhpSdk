<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "vtoken:", "effectprofiletoken:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$resp = $ziggeo->videos()->apply_effect($opts["vtoken"], array(
	"effectprofiletoken" => $opts["effectprofiletoken"]
));