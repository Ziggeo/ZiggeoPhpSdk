<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

while (TRUE) {
	$idx = $ziggeo->videos()->index();
	if (count($idx) === 0)
		break;
	foreach ($idx as $video) {
		echo "Deleting " . $video->token . " / " . @$video->key . "\n";
		$ziggeo->videos()->delete($video->token);
	}
}