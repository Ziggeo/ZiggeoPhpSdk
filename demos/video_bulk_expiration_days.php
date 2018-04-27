<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "videos:", "expiration_days:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$resp = $ziggeo->videos()->update_bulk(array(
	"tokens_or_keys" => $opts["videos"],
	"expiration_days" => @$opts["expiration_days"] ? $opts["expiration_days"] : null
));

var_dump($resp);
