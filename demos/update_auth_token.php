<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:","authtoken:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

var_dump($ziggeo->authtokens()->update($opts["authtoken"] ,array(
	"grants" => array(
		"read" => array(
			"session_owned" => TRUE
		)
	),
    "usage_expiration_time" => 86400,
	"session_limit" => 2

)));