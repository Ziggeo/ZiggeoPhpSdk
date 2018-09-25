<?php
/*
	This script will show you how to apply an effect on your existing video

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. video_token
	4. effect_profile_token
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "video_token:", "effect_profile_token:"));

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$result = $ziggeo->videos()->apply_effect($opts["video_token"], array(
	"effectprofiletoken" => $opts["effect_profile_token"]
));

var_dump($result);

?>