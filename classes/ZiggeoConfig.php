
<?php

Class ZiggeoConfig {
	
	public $config;
	
	function __construct() {
		$this->config = array(
            "regions" => array("r1" => "https://srvapi-eu-west-1.ziggeo.com", ),
			"server_api_url" => "https://srvapi.ziggeo.com",
            "api_regions" => array("r1" => "https://api-eu-west-1.ziggeo.com", ),
            "api_url" => "https://api-us-east-1.ziggeo.com",
            "request_timeout"=>60
		);
	}
	
	function get($ident) {
		return $this->config[$ident];
	}
	
}
