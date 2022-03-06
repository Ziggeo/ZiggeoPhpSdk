<?php
/*
	This script shows you how you can accept the webhooks and write down the data into the standard error output

	* This is just barebones example, please check other webhooks demos for more info
*/
	
$webhook_data = json_decode( file_get_contents('php://input'), true );

fwrite(fopen('php://stderr', 'w') , json_encode($webhook_data));

?>