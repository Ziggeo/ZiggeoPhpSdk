<?php
/*
	This script will push all videos in the application you have specified to your selected push service
	You'll need to:
		1. Create new integration in the dashboard
		2. Then create push service using the integration on your application's dashboard
		3. Grab the push service token and use it here.

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. push_token
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "push_token:"));

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$videos = array();
$skip = 0;
$limit = 100;

do {
	//We use Index like in videos_index.php, allowing us to do this
	$videos = $ziggeo->videos()->index(array(
		"skip" => $skip,
		"limit" => $limit
	));
	//we go through all of the found videos
	foreach ($videos as $video) {
		//push to service requires token of a video and push service, which is part of the array
		$data = array(
			"pushservicetoken" => $opts["push_token"]
		);

		//See videos_push_to_service.php
		$ziggeo->videos()->push_to_service($video->token, $data);
		print("Pushed ".$video->token." \n");

		//We use this for the index purposes (code at start of do loop)
		$skip++;
	}
} while (count($videos) > 0);

?>