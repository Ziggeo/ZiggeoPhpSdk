<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "url:", "encoding:", "events:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$ziggeo->webhooks()->create(array(
	"target_url" => $opts["url"],
	"encoding" => $opts["encoding"],
	"events" => $opts["events"]
));