<?php
/*
	This script will show you how you can delete all of the videos in your account

	Parameters you need to pass:
	1. app_token
	2. private_key
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:"));

$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

while (TRUE) {
	//see videos_index.php
	$idx = $ziggeo->videos()->index();

	if (count($idx) === 0) {
		break;
	}

	foreach ($idx as $video) {
		echo "Deleting " . $video->token . " / " . @$video->key . "\n";
		//See videos_delete.php
		$ziggeo->videos()->delete($video->token);
	}
}

?>