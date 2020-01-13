<?php
/*
	This script will copy all videos in the application you have specified to your other application
	* You can grab both application token and private keys from Overview pages of your applications

	Parameters you need to pass:
	1. source_app_token
	2. source_private_key
	3. target_app_token
	4. target_private_key
*/
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("source_app_token:", "source_private_key:", "target_app_token:", "target_private_key:"));

//We need to initialize SDK for each application that we have.
$ziggeo_source = new Ziggeo($opts["source_app_token"], $opts["source_private_key"]);
$ziggeo_target = new Ziggeo($opts["target_app_token"], $opts["target_private_key"]);

//temporary file stored on the server where the script is called from
$tmpfname = tempnam("/tmp", "ziggeo") . ".mp4";

$videos = array();
$skip = 0;
$limit = 50;

do {
    //We use Index like in videos_index.php, allowing us to do this
    $videos = $ziggeo_source->videos()->index(array(
        "skip" => $skip,
        "limit" => $limit
    ));
    //we go through all of the found videos
    foreach ($videos as $video) {
        $skip++; //We use this for the index purposes (code at start of do loop)
        try {
            $ziggeo_target->videos()->get("_" . $video->token);
        } catch (Exception $e) {
            $retry = 5;
            while ($retry > 0) {
                $retry--;
                try {
                    echo "Downloading #" . $skip . " : " . $video->token . "...\n";
                    file_put_contents($tmpfname, $ziggeo_source->videos()->download_video($video->token));

                    echo "Uploading #" . $skip . " : " . $video->token . "...\n";
                    //this is done same as in video_create.php file
                    $ziggeo_target->videos()->create(array(
                        "key" => $video->token,
                        "file" => $tmpfname
                    ));
                    break;
                } catch (Exception $e) {
                }
            }
        }
    }
} while (count($videos) > 0);

?>