<?php
/*
	This script will show you how to create an effect profile through API and to attach an Instagram like effect process.

	info: https://ziggeo.com/features/filter-effects

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. effect_title
	4. effect_key (optional)
	5. filter_process
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "effect_title:", "effect_key:", "filter_process:"));

$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$effect = $ziggeo->effectProfiles()->create(array(
	"title" => $opts["effect_title"],
	"key" => (!empty($opts["effect_key"])) ? $opts["effect_key"] : null
));

$filterOpts = array(
	"filter" => $opts["filter_process"]
);

$filter = $ziggeo->effectProfileProcess()->create_filter_process($effect->token, $filterOpts);

var_dump($filter);

?>