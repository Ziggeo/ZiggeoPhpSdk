<?php
	// setup Ziggeo and its parameter
	require_once(dirname(__FILE__) . "/../ZiggeoPhpSdk/Ziggeo.php");

	$ziggeo = new Ziggeo('API_TOKEN', 'PRIVATE_KEY');

	//we check the webhooks responses..

	// $webhook_data = json_decode( file_get_contents('php://input'), true );
	$webhook_data = $_POST; // get POST data
	
	if($webhook_data['event_type'] == 'video_stream_push_success'){
		// if the webhook type is video stream push success
		$detail_data = json_decode($webhook_data['data']); // extract video data to object
		$video_token = $detail_data->video->token; // get pushed video token
		$ziggeo->videos()->delete($video_token); // delete video by token
		print("video ".$video_token." has been deleted");	
	}else{
		print("not a push success webhook");
	}
	
?>