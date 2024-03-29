<?php
/*
	This script will show you how to update existing server side auth token

	docs: https://ziggeo.com/docs/api/authorization-tokens/

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. auth_token
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:","auth_token:"));

$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$result = $ziggeo->authtokens()->update($opts["auth_token"] ,array(
	"grants" => array(
		"read" => array(
			"session_owned" => TRUE
		)
	),
	"usage_expiration_time" => 86400,
	"session_limit" => 2

));

var_dump($result);

?>