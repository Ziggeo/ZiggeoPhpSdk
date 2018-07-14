<?php
/*
    This script will push all videos on the application to your selected push service
    You'll need to create new integration then push service on using the integration on your application's dashboard
    Then you can get PUSHTOKEN to be used here
    Usage:
    php application_push.php --token APP_TOKEN --privatekey PRIVATEKEY --pushtoken PUSHTOKEN
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "pushtoken:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

// $tmpfname = tempnam("/tmp", "ziggeo") . ".mp4";

$videos = array();
$skip = 0;
$limit = 100;

do {
    $videos = $ziggeo->videos()->index(array(
        "skip" => $skip,
        "limit" => $limit
    ));
    foreach ($videos as $video) {
        $data = array(
            "pushservicetoken" => $opts["pushtoken"]
        );
        $ziggeo->videos()->push_to_service($video->token, $data);
        print("Pushed ".$video->token." \n");
        $skip++;
    }
} while (count($videos) > 0);
