<?php

require_once(dirname(__FILE__) . "/../vendor/autoload.php");
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

var_dump($ziggeo->authtokens()->create(array(
	"grants" => array(
		"read" => array(
			"all" => TRUE
		)
	)
)));