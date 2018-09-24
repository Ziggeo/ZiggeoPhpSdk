<?php
/*
	This script will show you how to get analytics data for a specific video

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. video_token
	4. filter_date
	5. filter_from
	6. filter_to
	7. filter_query
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "video_token:", "filter_date:", "filter_from:", "filter_to:", "filter_query:"));

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$analytics = $ziggeo->videos()->analytics($opts["video_token"], array(
	"from" => (isset($opts["filter_from"])) ? $opts["filter_from"] : NULL,
	"to" => (isset($opts["filter_to"])) ? $opts["filter_to"] : NULL,
	"date" => (isset($opts["filter_date"])) ? $opts["filter_date"] : NULL,
	"query" => $opts["filter_query"]
));

var_dump($analytics);

?>