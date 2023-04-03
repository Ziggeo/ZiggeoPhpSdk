<?php

// The goal of this demo is to show how to remove videos that are created before some date
// We suggest turning on the video deletition prevention for at least 1 day to make sure you can restore
// any of your videos, otherwise they will be permanently removed.
// the 'limit' => 100 line refers only to the number of videos fetched at one time, not the maximum number of videos that will be removed.

require_once(dirname(__FILE__) . "/../Ziggeo.php");

// Information that you should modify

$app_token = 'APP_TOKEN'; // Your APP token, found under APP > Overview
$private_key = 'PRIVATE_KEY'; // Your Private Key, found under APP > Overview
$before_date = 'YYYY-MM-DD'; // Videos created before this date will be deleted

// Do not modify bellow this line

$ziggeo = new Ziggeo($app_token, $private_key);

function created_before($created, $date) {

	$created_at = new DateTime(date('Y-m-d H:i:s', $created));
	$before_date = new DateTime($date);

	return $created_at < $before_date;
}

$params = array(
	'limit' => 100,
	'skip' => 0
);

while(true) {

	$videos = $ziggeo->videos()->index($params);

	if (empty($videos)) {
		break;
	}

	foreach ($videos as $video) {
		if (created_before($video['created'], $before_date)) {
			echo "\n<br>" . 'Removing: ' . $video['token'];
			$ziggeo->videos()->delete($video['token']);
		}
	}

	$params['skip'] += $params['limit'];
}

?>