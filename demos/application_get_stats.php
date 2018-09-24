<?php
/*
	This script will allow you to get the stats of your application

	Parameters you need to pass:
	1. app_token
	2. private_key
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:"));

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$result = $ziggeo->application()->get_stats();

var_dump($result);

?>