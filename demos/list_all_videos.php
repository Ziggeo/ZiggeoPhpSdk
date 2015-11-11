<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$idx = $ziggeo->videos()->index();
foreach ($idx as $video) {
	echo "Listing " . $video->token . " / " . @$video->key . "\n";
}
