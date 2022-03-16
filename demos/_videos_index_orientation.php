<?php
/*
	This script will show you how you can get the list of videos from your account

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
$count_landscape = 0;
$count_portrait = 0;

do {
	$videos = $ziggeo->videos()->index(array(
		"skip" => $skip,
		"limit" => $limit
	));

	//we go through all of the found videos
	foreach ($videos as $video) {
		//We print out the list of the videos we found
		
		if ($video->streams[0]->video_width > $video->streams[0]->video_height){
			print("landscape\n");
			$count_landscape += 1;
		} else {
			print("portrait\n");
			$count_portrait += 1;
		}
		// echo "Listing " . $video->token . " / " . @$video->key . "\n";
		$skip++; //We use this for the index purposes (code at start of do loop)
	}
} while (count($videos) > 0);

print("Portrait count = ".$count_portrait." Portrait Percentage = ".(($count_portrait/($count_landscape+$count_portrait))*100)."%\n");
print("Landscape count = ".$count_landscape." Landscape Percentage = ".(($count_landscape/($count_landscape+$count_portrait))*100)."%");
?>