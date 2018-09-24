<?php
/*
	This script will show you how you can get the number of all videos in your application

	Parameters you need to pass:
	1. app_token
	2. private_key
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:"));

$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$result = $ziggeo->videos()->count();

var_dump($result);

?>