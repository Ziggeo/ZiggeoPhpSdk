<?php
/*
	This script will show you how to create an effect profile through API

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. effect_title
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "effect_title:"));

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$effect = $ziggeo->effectProfiles()->create(array(
	"title" => $opts["effect_title"]
));

var_dump($effect);

?>