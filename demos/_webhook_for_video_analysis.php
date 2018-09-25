<?php

	//we check the webhooks responses..

	$webhook_data = json_decode( file_get_contents('php://input'), true );

	$event_type = $webhook_data['event_type']; //it would be 'video_analysis'

	$video_data = $webhook_data['data']['video'];

	//lets get token and key
	$video_token = $video_data['token']; //we could have written this as $_POST['data']['video']['token'];
	$video_key = $video_data['key']; //like the above, we could have written this as $_POST['data']['video']['key'];

	//used tags
	$video_tags = $video_data['tags'];

	$has_video_profile = ( $video_data['video_profile'] !== null ) ? true : false;
	$has_meta_profile = ( $video_data['meta_profile'] !== null ) ? true : false;
	$has_effect_profile = ( $video_data['effect_profile'] !== null ) ? true : false;

	$streams = $video_data['streams']; //at this stage video streams exist, and they are objects like video object
		//streams contain additional details specific to video stream.

	$created_on = date('Y-m-d H:i:s', $video_data['created']); //it is UNIX epoch time hence this formatting

	$custom_data = $video_data['data']; //custom data sent with video

	$device_info = $video_data['device_info']; //if you like to see what system someone was using when creating videos
											   // (it will not be present on all videos).

	$is_HD = $video_data['hd'];

	//if we are after details detected on the frames of the video through our visual analysis feature the following
	// would be of interest
	$visual_data = $video_data['original_stream']['video_analysis'];
	
	$timestamps = $visual_data['timestamps']; //they tell us the seconds in the video where something happened
	$classes = $visual_data['classes']; //this gives us types / classes of elements found. For example if you were
										// recording yourself with white background it would say something like
										// "portrait, {gender}, adult, facial expression, etc.
	$scores = $visual_data['scores']; //this gives you a score of each class expressed above

	//with these details you could grab any timestamp, see the classes for the same (array of classes), with their
	// scores, so for example at 5th second, you can see that someone had shown a cup and that system is certain that it
	// is a cup with the score for the same.
	// Same can be used to as nudity detection, allowing you to react to the same appropriately. 


	//now we have various details, it is up to you if they would be saved in some file, DB or if some action should run
	// when this happens.
?>