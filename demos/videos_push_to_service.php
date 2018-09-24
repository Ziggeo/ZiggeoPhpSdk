<?php
/*
	This script will show you how you can push a video to some auto push service you have previously configured.

	You'll need to:
	1. Create new integration in the dashboard
	2. Then create push service using the integration on your application's dashboard
	3. Grab the push service token and use it here.

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. video_token
	4. push_service_token
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "video_token:", "push_service_token:"));

if (empty($opts["push_service_token"])) {
	die ("Must provide a push service token");
}

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$data = array(
	"pushservicetoken" => $opts["push_service_token"]
);

$ziggeo->videos()->push_to_service($opts["video_token"], $data);

?>