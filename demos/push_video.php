<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "vtoken:", "pstoken:"));

if (empty($opts["pstoken"])) {
    die ("Must provide a push service token");
}

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$data = array(
    "pushservicetoken" => $opts["pstoken"]
);

$ziggeo->videos()->push_to_service($opts["vtoken"], $data);
