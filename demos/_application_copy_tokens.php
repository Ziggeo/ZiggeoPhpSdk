<?php
require_once(dirname(__FILE__) . "/../Ziggeo.php");

$opts = getopt("", array("source_app_token:", "source_private_key:", "target_app_token:", "target_private_key:", "videos:"));

//We need to initialize SDK for each application that we have.
$ziggeo_source = new Ziggeo($opts["source_app_token"], $opts["source_private_key"]);
$ziggeo_target = new Ziggeo($opts["target_app_token"], $opts["target_private_key"]);

//temporary file stored on the server where the script is called from
$tmpfname = tempnam("/tmp", "ziggeo") . ".mp4";

$videos = explode(",", $opts["videos"]);

foreach ($videos as $video_token) {
    try {
        $ziggeo_target->videos()->get("_" . $video_token);
    } catch (Exception $e) {
        $retry = 5;
        while ($retry > 0) {
            $retry--;
            try {
                echo "Downloading #" . " : " . $video_token . "...\n";
                file_put_contents($tmpfname, $ziggeo_source->videos()->download_video($video_token));

                echo "Uploading #" . " : " . $video_token . "...\n";
                //this is done same as in video_create.php file
                $ziggeo_target->videos()->create(array(
                    "key" => $video_token,
                    "file" => $tmpfname
                ));
                break;
            } catch (Exception $e) {
            }
        }
    }
}

?>