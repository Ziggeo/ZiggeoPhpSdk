<?php
/*
	This script will show you how to delete auth token

	docs: https://ziggeo.com/docs/api/authorization-tokens/

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. auth_token
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:","auth_token:"));

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$result = $ziggeo->authtokens()->delete($opts["auth_token"]);

var_dump($result);

?>