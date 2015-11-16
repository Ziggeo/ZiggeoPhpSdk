<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "vtoken:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$ziggeo->videos()->update($opts["vtoken"], array(
	"approved" => TRUE
));