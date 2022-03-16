<?php
	// add your own Application token and private key, you can get them on Ziggeo Dashboard

	$app_token = "APP_TOKEN";
	$private_key = "PRIVATE_KEY";

	// start handling input

	$webhook_data = json_decode( file_get_contents('php://input'), true );

	$event_type = $webhook_data['event_type']; //it would be 'video_stream_push_success'

	$video_data = $webhook_data['data']['video'];

	
	if($event_type == 'video_stream_push_success'){
		// setup Ziggeo here, so it won't triggered whenever other event is called
		require_once(dirname(__FILE__) . "/../Ziggeo.php");
		
		$ziggeo = new Ziggeo($app_token, $private_key);
		
		$video_token = $video_data['token'];

		//See videos_delete.php for more info
		$ziggeo->videos()->delete($video_token); // delete video by token
	}
	
?>