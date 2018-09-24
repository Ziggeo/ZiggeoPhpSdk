<?php
/*
	//This script is used to create a webhook

	docs: https://ziggeo.com/docs/api/webhooks/

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. url (where webhooks should fire to)
	4. encoding (webhook encoding to use)
	5. events (events you want webhook to fire for)
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "url:", "encoding:", "events:"));

//We initialize the SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$ziggeo->webhooks()->create(array(
	"target_url" => $opts["url"],
	"encoding" => $opts["encoding"],
	"events" => $opts["events"]
));

?>