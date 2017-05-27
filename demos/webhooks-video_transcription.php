<?php

	//we check the webhooks responses..

	$webhook_data = json_decode( file_get_contents('php://input'), true );

	$event_type = $webhook_data['event_type']; //for video created it would be 'video_transcription'

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

	//if we are after text that has been transcribed from the video it is best to grab it from original stream
	$transcription_data = $video_data['original_stream']['audio_transcription'];

	$words = $transcription_data['words']; //comma separated list of all words that were found in video
	$word_scores = $transcription_data['scores']; //scores of the words above, allowing you to see how certain our
												  // system is of that word being there
	$times = $transcription_data['times']; //comma separated objects with start and end time of the words (same order
										   // as words)
	$entire_text = $transcription_data['text']; //complete text of the text received from the video
	$video_topic = $transcription_data['topics']; //topic or topics that transcription system thinks is the topic of
												  // the video
	$transcribed_keywords = $transcription_data['keywords']; //not to be confused with audio_keywords, these keywords
															 // are based on detected text, and such are likely to be
															 // slightly more accurate.

	$audio_keywords = $video_data['original_stream']['$audio_keywords']; //keywords that were detected during parsing

	//with just these details we would be able to setup up a system that would collect the words in a given timeframe
	// and quickly create subtitles, however of course that is up to you - what you would do with the same :)


	//now we have various details, it is up to you if they would be saved in some file, DB or if some action should run
	// when this happens.
?>