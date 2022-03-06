<?php
/*
	This script will show you how you can create a video by uploading a file

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. filename
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "filename:"));

$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$ziggeo->videos()->create(array(
	"file" => $opts["filename"] //path and name with extension
));

?>