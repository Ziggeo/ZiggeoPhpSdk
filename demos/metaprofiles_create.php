<?php
/*
	This script will show you how to create a meta profile

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. meta_title
	4. meta_key
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "meta_title:", "meta_key::"));

$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$arguments = array(
	"title" => $opts["meta_title"],
	"key" => $opts["meta_key"]
);

var_dump($arguments);

$ziggeo->metaProfiles()->create($arguments);

?>