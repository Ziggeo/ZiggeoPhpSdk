<?php
/*
	This script will show you how to create a meta profile and attach NSFW process

	Info: https://ziggeo.com/features/nsfw

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. meta_profiles_token
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "meta_profiles_token:"));

//We initiate our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$meta_profiles_token = $opts["meta_profiles_token"];

$ziggeo->metaProfileProcess()->create_nsfw_process($meta_profiles_token, array("nsfw_action"=>"reject"));

?>