<?php
/*
	//This script is used to create a webhook

	docs: https://ziggeo.com/docs/api/webhooks/

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. webhook_id (webhook id that's returned when using webhooks()->create())
	4. validation_code (6-digit code sent to the webhook after creating it)
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "webhook_id:", "validation_code:"));

//We initialize the SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$arguments = array(
	"webhook_id"      => $opts["webhook_id"],
	"validation_code" => $opts["validation_code"]
);

$ziggeo->webhooks()->confirm($arguments);

?>