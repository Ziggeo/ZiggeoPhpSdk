<?php
/*
	This script will show you how you can get browser used from the list of videos from your account

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
$test = 0;
$browsers = array();
$total_browser = 0;
do {
	$videos = $ziggeo->videos()->index(array(
		"skip" => $skip,
		"limit" => $limit
	));

	//we go through all of the found videos
	foreach ($videos as $video) {
		$test += 1;
		
		if(isset($video->device_info)) {
			$browser  = $video->device_info->browser;
			// print('test '.$test." ".$browser."\n");
		}
		else {
			$browser = "Unknown";
			// print('test '.$test." Unknown\n");
		}
		if (!array_key_exists($browser, $browsers)) {
			$browsers[$browser] = 1;
		}
		else {
			$browsers[$browser] += 1;
		}
		
		$total_browser += 1;
		// print_r($video->device_info);		
		$skip++; //We use this for the index purposes (code at start of do loop)
	}
} while (count($videos) > 0);

foreach ($browsers as $key => $value) {
	print("Browser ".$key.": ".$value." (".(($value/$total_browser)*100)."%)\n");
}
?>