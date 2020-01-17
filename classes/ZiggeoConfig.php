
<?php

Class ZiggeoConfig {
	
	public $config;
	
	function __construct() {
		$this->config = array(
            "regions" => array("r1" => "https://srvapi-eu-west-1.ziggeo.com", ),
			"server_api_url" => "https://srvapi.ziggeo.com",
            "api_regions" => array("r1" => "https://api-eu-west-1.ziggeo.com", ),
            "api_url" => "https://api-us-east-1.ziggeo.com",
            "request_timeout" => 60,
            "resilience_factor" => 5,
            "resilience_onfail" => [ "error" => true ] //change this to represent code that returns if your server does not reach our server for some reason even after few attempts. Can be any valid code that your code can look out for.
		);
	}
	
	function get($ident) {
		return $this->config[$ident];
	}

    function set($ident, $value) {
        $this->config[$ident] = $value;
        return $this;
    }
	
}
