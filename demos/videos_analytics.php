<?php
/*
	This script will show you how to get analytics data for a specific video

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. video_token
	4. filter_query
	5. filter_from
	6. filter_to
	7. filter_date
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "video_token:", "filter_query:", "filter_from:", "filter_to:", "filter_date::"));

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$arguments = array(
	"query" => $opts["filter_query"] // can be any of: device_views_by_os, device_views_by_date,
	                                 //   total_plays_by_country, full_plays_by_country, total_plays_by_hour,
	                                 //   full_plays_by_hour, total_plays_by_browser, full_plays_by_browser
);

if(isset($opts["filter_from"])) {
	$arguments['from'] = $opts["filter_from"];
}
if(isset($opts["filter_to"])) {
	$arguments['to'] = $opts["filter_to"];
}
if(isset($opts["filter_date"])) {
	$arguments['date'] = $opts["filter_date"];
}

$analytics = $ziggeo->videos()->analytics($opts["video_token"], $arguments);

var_dump($analytics);

?>