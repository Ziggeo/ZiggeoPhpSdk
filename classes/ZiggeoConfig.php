<?php

Class ZiggeoConfig {
	
	private $config;
	
	function __construct() {
		$this->config = array(
			"local" => FALSE,
			"server_api_url" => "https://srvapi.ziggeo.com",
		);
				
	}
	
	function get($ident) {
		return $this->config[$ident];
	}
	
}
