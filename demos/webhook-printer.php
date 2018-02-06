<?php

	$webhook_data = json_decode( file_get_contents('php://input'), true );

    fwrite(fopen('php://stderr', 'w') , json_encode($webhook_data));

?>