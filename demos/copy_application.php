<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("sourcetoken:", "sourceprivatekey:", "targettoken:", "targetprivatekey:"));

$ziggeoSource = new Ziggeo($opts["sourcetoken"], $opts["sourceprivatekey"]);
$ziggeoTarget = new Ziggeo($opts["targettoken"], $opts["targetprivatekey"]);

$tmpfname = tempnam("/tmp", "ziggeo") . ".mp4";

$videos = array();
$skip = 0;
$limit = 50;

do {
    $videos = $ziggeoSource->videos()->index(array(
        "skip" => $skip,
        "limit" => $limit
    ));
    foreach ($videos as $video) {
        $skip++;
        echo "Downloading #" . $skip . " : " . $video->token . "...\n";
        file_put_contents($tmpfname, $ziggeoSource->videos()->download_video($video->token));
        echo "Uploading #" . $skip . " : " . $video->token . "...\n";
        $ziggeoTarget->videos()->create(array(
            "file" => $tmpfname
        ));
    }
} while (count($videos) > 0);
