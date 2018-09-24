<?php
/*
	This script will show you how to apply a meta profile to your existing video

	Parameters you need to pass:
	1. app_token
	2. private_key
	3. video_token
	4. meta_profile_token
*/
require_once(dirname(__FILE__) . '/../Ziggeo.php');

$opts = getopt('', array('app_token:', 'private_key:', 'video_token:', 'meta_profile_token:'));

//We initialize our SDK
$ziggeo = new Ziggeo($opts['app_token'], $opts['private_key']);

//Must be token, can not be a key
$arguments = array(
	'metaprofiletoken' => $opts['meta_profile_token']
);

$result = $ziggeo->videos()->apply_meta($opts['video_token'], $arguments);

var_dump($result);

?>