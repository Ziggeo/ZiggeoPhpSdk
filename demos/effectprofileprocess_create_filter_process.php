<?php
/*
	This script will show you how to create an effect profile through API and to attach an Instagram like effect process.

	info: https://ziggeo.com/features/filter-effects

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. effect_profile_token
	4. filter_process
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "effect_profile_token:", "filter_process:"));

$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$filterOpts = array(
	"filter" => $opts["filter_process"]
);

$effect_profile_token = $opts["effect_profile_token"];

$filter = $ziggeo->effectProfileProcess()->create_filter_process($effect_profile_token, $filterOpts);

var_dump($filter);

?>