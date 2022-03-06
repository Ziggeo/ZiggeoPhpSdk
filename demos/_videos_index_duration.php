<?php
/*
	This script will show you how you can get the average duration from the list of videos from your account

	Parameters you need to pass:
	1. app_token
	2. private_key
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:"));

$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$videos = array();
$skip = 0;
$limit = 100;
$total_duration = 0;
$count_duration = 0;

do {
	$videos = $ziggeo->videos()->index(array(
		"skip" => $skip,
		"limit" => $limit
	));

	//we go through all of the found videos
	foreach ($videos as $video) {
		$total_duration += $video->duration;
		$count_duration += 1;
		$skip++; //We use this for the index purposes (code at start of do loop)
	}
} while (count($videos) > 0);

print("Total Duration = ".$total_duration." seconds, Average Duration = ".($total_duration/$count_duration)."seconds\n");

?>