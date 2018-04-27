<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "videos:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

var_dump($ziggeo->videos()->get_bulk(array("tokens_or_keys" => $opts["videos"])));
