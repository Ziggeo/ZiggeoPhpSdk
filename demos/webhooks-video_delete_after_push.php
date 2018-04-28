<?php
	// add your own Application token and private key, you can get them on Ziggeo Dashboard

	$app_token = "f9402c3576ed13819e7e5bb4ea3a8baa";
	$private_key = "518d2a580c4ad2cd18335eece3189a84";

	// start handling input

	$webhook_data = json_decode( file_get_contents('php://input'), true );

    $event_type = $webhook_data['event_type']; //it would be 'video_stream_push_success'

	$video_data = $webhook_data['data']['video'];

	
	if($event_type == 'video_stream_push_success'){
		// setup Ziggeo here, so it won't triggered whenever other event is called
		require_once(dirname(__FILE__) . "/../Ziggeo.php");
		
		$ziggeo = new Ziggeo($app_token, $private_key);
		
		$video_token = $video_data['token'];

		$ziggeo->videos()->delete($video_token); // delete video by token
	}
	
?>