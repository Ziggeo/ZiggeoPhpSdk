<?php
/*
	This script will allow you to see how to create client side auth tokens

	docs: https://ziggeo.com/docs/api/authorization-tokens/

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. encryption_key
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "encryption_key:"));

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"], $opts["encryption_key"]);

$result = $ziggeo->auth()->generate(array(
	"grants" => array(
		"read" => array(
			"all" => TRUE
		)
	)
));

var_dump($result);

?>