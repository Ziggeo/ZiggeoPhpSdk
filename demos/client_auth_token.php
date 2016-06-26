<?php

require_once(dirname(__FILE__) . "/../vendor/autoload.php");
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "encryptionkey:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"], $opts["encryptionkey"]);

var_dump($ziggeo->auth()->generate(array(
	"grants" => array(
		"read" => array(
			"all" => TRUE
		)
	)
)));