<?php
/*
	This script will show you how you can update the expiration days of your videos using videos->update()

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. video_token
	4. expiration_days
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "video_token:", "expiration_days:"));

$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

//see videos_update.php
$ziggeo->videos()->update($opts["video_token"], array(
	"expiration_days" => @$opts["expiration_days"] ? $opts["expiration_days"] : null
));

?>