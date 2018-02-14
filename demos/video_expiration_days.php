<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "vtoken:", "expiration_days:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$ziggeo->videos()->update($opts["vtoken"], array(
	"expiration_days" => @$opts["expiration_days"] ? $opts["expiration_days"] : null
));
