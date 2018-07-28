<?php

Class ZiggeoConfig {
	
	public $config;
	
	function __construct() {
		$this->config = array(
            "regions" => array("r1" => "https://srvapi-eu-west-1.ziggeo.com", ),
			"server_api_url" => "https://srvapi.ziggeo.com",
		);
	}
	
	function get($ident) {
		return $this->config[$ident];
	}
	
}
