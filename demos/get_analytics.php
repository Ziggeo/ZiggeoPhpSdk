<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "date:", "from:", "to:", "query:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$analytics = $ziggeo->analytics()->get(array(
	"from" => (@$opts["from"]) ? $opts["from"] : NULL,
	"to" => (@$opts["to"]) ? $opts["to"] : NULL,
	"date" => (@$opts["date"]) ? $opts["date"] : NULL,
	"query" => $opts["query"]
));

print_r($analytics);