<?php
/*
	This script will allow you to test out the times for uploading, downloading and removal of videos.
	* The way it works will not remove your existing videos, just the ones that were uploaded by this script.

	docs: https://ziggeo.com/docs/api/authorization-tokens/

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. file_path
	4. max_cycles
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("app_token:", "private_key:", "file_path:", "max_cycles:"));

//We initialize our SDK
$ziggeo = new Ziggeo($opts["app_token"], $opts["private_key"]);

$videos = array();
//default time values
$times = array(
	"upload" => 0.0,
	"download" => 0.0,
	"delete" => 0.0
);

// Video creation times test (upload)

//get current time (see php time() for more details on how this works)
$time = time();

for ($i = 0; $i < $opts["max_cycles"]; ++$i) {
	//See video_create.php in demos for more
	$videos[] = $ziggeo->videos()->create(array("file" => $opts["file_path"]));
}
//How long it took?
$times["upload"] += time()-$time;

// Video download times test (download)

$tmpfname = tempnam("/tmp", "ziggeo") . ".mp4";
//get new current time
$time = time();

foreach ($videos as $video) {
	//See video_download.php or video_download_all.php in demos
	file_put_contents($tmpfname, $ziggeo->videos()->download_video($video->token));
}
//How long it took?
$times["download"] += time()-$time;

// Video removal test (delete)

//get new current time
$time = time();

//Remove all 
foreach ($videos as $video) {
	//See video_delete.php and video_delete_all.php in demos
	$ziggeo->videos()->delete($video->token);
}
//How long it took?
$times["delete"] += time()-$time;

//Print out the times (the average)
echo ("Upload: " . ($times["upload"] / $opts["max_cycles"]) . "\n");
echo ("Download: " . ($times["download"] / $opts["max_cycles"]) . "\n");
echo ("Delete: " . ($times["delete"] / $opts["max_cycles"]) . "\n");

?>