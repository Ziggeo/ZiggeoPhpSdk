<?php
/*
	This script shows you how to remove the webhook
	* It removes by URL, so all webhooks with the same URL will be removed at once!

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. url
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "url:"));

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$ziggeo->webhooks()->delete(array(
	"target_url" => $opts["url"]
));

?>