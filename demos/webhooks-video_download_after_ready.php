<?php
	// add your own Application token and private key, you can get them on Ziggeo Dashboard

	$app_token = "APP_TOKEN";
	$private_key = "PRIAVTE_KEY";

	// start handling input

	$webhook_data = json_decode( file_get_contents('php://input'), true );

    $event_type = $webhook_data['event_type']; //it would be 'video_ready'

	$video_data = $webhook_data['data']['video'];

	// fwrite(fopen('php://stderr', 'w') , $event_type);
	if($event_type == 'video_ready'){
		// setup Ziggeo here, so it won't triggered whenever other event is called
		require_once(dirname(__FILE__) . "/../Ziggeo.php");
		
		$ziggeo = new Ziggeo($app_token, $private_key);
		
		$video_token = $video_data['token'];
		$file_name = $video_token.".mp4"; // create new file name based on token's

		$file_content = $ziggeo->videos()->download_video($video_token) ; // get the file from server
		file_put_contents($file_name, $file_content); // put the content to the new file
	}

?>