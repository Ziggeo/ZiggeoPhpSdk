<?php

// Uploading multiple files to the Ziggeo servers through PHP SDK

//This works by passing the the string representation of the path to the folder/directory with the video files, and the extensions to ignore. By default it will ignore "." and ".."

//Needed steps:
// 1. Download the latest Ziggeo PHP SDK from GitHub https://github.com/Ziggeo/ZiggeoPhpSdk
// 2. extract the files
// 3. reference the files in this file
// 4. Add correct details from your app
// 5. submit your videos

// This is called from cli / command line with a call such as: php /var/www/html/upload_multiple_videos_from_command_line.php pushVideos "/var/www/videos/" "tag1,tag2,tag3" ".,.."
// then we get the following:
// $argv[0] === /var/www/html/upload_multiple_videos_from_command_line.php
// $argv[1] === pushVideos
// $argv[2] === "/var/www/videos/"
// $argv[3] === "tag1,tag2,tag3" (optional)
// $argv[4] === ".php,.,.." (optional)

define('APP_TOKEN', '');
define('PRIVATE_KEY', '');

//Do we have a minimum required to make this work?
if(isset($argv, $argv[1], $argv[2])) {
    //we do, great

    if(function_exists($argv[1]))
    {
        if(!isset($argv[3])) {
            //Calling the right function with just the video folder
            $argv[1]($argv[2]);
        }
        elseif(!isset($argv[4])) {
            //calling the function with video folder and custom tags
            $argv[1]($argv[2], $argv[3]);
        }
        else {
            //calling the function with video folder, tags and files to ignore.
            $argv[1]($argv[2], $argv[3], $argv[4]);
        }
    }
}

function pushVideos($videosDir, $tags = 'phpBulkImport', $ignoreList = '.,..') {
    //This is where we actually process everything

    $ignoreList = explode(',', $ignoreList);

    //We require the Ziggeo SDK Entry file
    require_once('Ziggeo.php');

    $arguments = Array( 'tags' => $tags );

    //console output styling
    echo "\n";
    echo "******************************************************\n";
    echo "       Pushing multiple videos to Ziggeo servers      \n";
    echo "******************************************************\n";
    echo "\n";

    //Data for output..
    $count = 0;

    $ziggeo = new Ziggeo(APP_TOKEN, PRIVATE_KEY);

    //Get all files in the mentioned folder
    $files = @scandir($videosDir); //If you are getting errors, remove @ to see what is the cause..

    if($files) {
        //we run it like this, which will remove . and .. and other files if you have specified any with full name
        $files = array_diff($files, $ignoreList);
    }

    if(!$files) {
        echo 'No videos found to execute the push';
        exit;
    }

    $c = count($files);

    foreach($files as $file) {

        //Setting up the arguments to pass over.. of course we can do this differently, this is just for example, but remember that each video has a different name while other parameters would be shared!
        $tmp_arguments = $arguments;
        $tmp_arguments['file'] = $videosDir . '/' . $file;

        //the actual passing of the videos to Ziggeo from our PC / Mac
        $ziggeo->videos()->create($tmp_arguments);

        //This is just for display purposes upon the upload
        $count++;
        echo "Pushed: " . $count . ". \"" . $file . "\"\n";
    }

    //console output styling
    echo "\n";
    echo "******************************************************\n";
    echo "  Push complete - please check your Ziggeo dashboard  \n";
    echo "******************************************************\n";
    echo "\n";
}