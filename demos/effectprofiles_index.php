<?php
/*
	This script will show you how to get the list of all effect profiles you have created under your application

	Parameters you need to pass:
	1. app_token
	2. private_key
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:"));

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$effects = $ziggeo->effectProfiles()->index();

var_dump($effects);

?>