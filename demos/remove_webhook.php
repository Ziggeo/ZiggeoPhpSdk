<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "url:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$ziggeo->webhooks()->delete(array(
	"target_url" => $opts["url"]
));