<?php

require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("token:", "privatekey:", "file:", "ops:"));

$ziggeo = new Ziggeo($opts["token"], $opts["privatekey"]);

$videos = array();
$times = array(
    "upload" => 0.0,
    "download" => 0.0,
    "delete" => 0.0
);

$time = time();
for ($i = 0; $i < $opts["ops"]; ++$i)
    $videos[] = $ziggeo->videos()->create(array("file" => $opts["file"]));
$times["upload"] += time()-$time;

$tmpfname = tempnam("/tmp", "ziggeo") . ".mp4";
$time = time();
foreach ($videos as $video)
    file_put_contents($tmpfname, $ziggeo->videos()->download_video($video->token));
$times["download"] += time()-$time;

$time = time();
foreach ($videos as $video)
    $ziggeo->videos()->delete($video->token);
$times["delete"] += time()-$time;

echo ("Upload: " . ($times["upload"] / $opts["ops"]) . "\n");
echo ("Download: " . ($times["download"] / $opts["ops"]) . "\n");
echo ("Delete: " . ($times["delete"] / $opts["ops"]) . "\n");