<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:","authtoken:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

var_dump($ziggeo->authtokens()->delete($opts["authtoken"]));
