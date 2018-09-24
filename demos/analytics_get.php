<?php
/*
	This script will show you how to get analytics data for your application

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. filter_date
	4. filter_from
	5. filter_to
	6. filter_query
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "filter_date:", "filter_from:", "filter_to:", "filter_query:"));

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$analytics = $ziggeo->analytics()->get(array(
	"from" => (isset($opts["filter_from"])) ? $opts["filter_from"] : NULL,
	"to" => (isset($opts["filter_to"])) ? $opts["filter_to"] : NULL,
	"date" => (isset($opts["filter_date"])) ? $opts["filter_date"] : NULL,
	"query" => $opts["filter_query"]
));

var_dump($analytics);

?>