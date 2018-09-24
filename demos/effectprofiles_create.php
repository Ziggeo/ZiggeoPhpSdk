<?php
/*
	This script will show you how to create an effect profile through API

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. effect_title
	4. effect_key (optional)
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "effect_title:", "effect_key:"));

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$effect = $ziggeo->effectProfiles()->create(array(
	"title" => $opts["effect_title"],
	"key" => (!empty($opts["effect_key"])) ? $opts["effect_key"] : null
));

var_dump($effect);

?>