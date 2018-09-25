<?php

	//we check the webhooks responses..

	$webhook_data = json_decode( file_get_contents('php://input'), true );

	$event_type = $webhook_data['event_type']; //it would be 'video_stream_push_success'

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

	//if we need details about the stream that has been pushed:
	$pushed_stream = $webhook_data['data']['stream'];

	//if we need details about the service where the video was pushed to..
	$push_service_info = $webhook_data['data']['push'];

	$push_service_token = $push_service_info['token'];
	$push_to = $push_service_info['title']; //this uses title that you had set up for the push service

	$is_autopush = $push_service_info['auto_push']; //if the push was made manually or automatically, this would tell

	$push_service = $push_service_info['type']; //what is the type of push service - Google Drive would be
												// "ApiGoogleDrivePush" for example

	//now we have various details, it is up to you if they would be saved in some file, DB or if some action should run
	// when this happens.
?>