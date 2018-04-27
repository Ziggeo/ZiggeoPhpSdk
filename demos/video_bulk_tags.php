<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "videos:", "tags:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$resp = $ziggeo->videos()->update_bulk(array(
	"tokens_or_keys" => $opts["videos"],
	"tags" => @$opts["tags"] ? $opts["tags"] : null
));

var_dump($resp);
