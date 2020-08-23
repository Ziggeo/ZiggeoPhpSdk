
<?php

Class ZiggeoConfig {
	
	public $config;
	
	function __construct() {
		$this->config = array(
            "regions" => array("r1" => "https://srvapi-eu-west-1.ziggeo.com", ),
			"server_api_url" => "https://srvapi.ziggeo.com",
            "api_regions" => array("r1" => "https://api-eu-west-1.ziggeo.com", ),
            "api_url" => "https://api-us-east-1.ziggeo.com",
            "cdn_regions" => array("r1" => "https://video-cdn-eu-west-1.ziggeo.com", ),
            "cdn_url" => "https://video-cdn.ziggeo.com",
            "request_timeout" => 60,
            "resilience_factor" => 5,
            "resilience_onfail" => [ "error" => true ], //change this to represent code that returns if your server does not reach our server for some reason even after few attempts. Can be any valid code that your code can look out for.
            //In general you do not need that info, just useful for any debugging
            "info"                    => array(
                "progress_show"       => false,
                "progress_multiplier" => 1048576, //1 for bytes, 1024 for kb, 1048576 for mb, 1073741824 for gb
                "progress_desc"       => 'mb'        //mb per above
            )
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