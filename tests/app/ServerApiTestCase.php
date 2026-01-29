<?php

Class Globals {
	
	public static $VIDEO_FILE = "";
	public static $NOVIDEO_FILE = "";
	public static $CONFIG = array();
	
}

Globals::$VIDEO_FILE = dirname(__FILE__) . "/../assets/video1s.mp4";
Globals::$NOVIDEO_FILE = dirname(__FILE__) . "/../assets/novideo.mp4";

Globals::$CONFIG = json_decode($_SERVER['argv'][2], TRUE);

require_once(dirname(__FILE__) . "/../../Ziggeo.php");

Class ServerApiTestCase extends PHPUnit\Framework\TestCase {
	
	protected $ziggeo = null;
	
	private function init() {
		if ($this->ziggeo === null)
			$this->ziggeo = new Ziggeo(Globals::$CONFIG["application_token"], Globals::$CONFIG["private_key"]);
        if (isset(Globals::$CONFIG["config"]))
            $this->ziggeo->config()->config = array_merge($this->ziggeo->config()->config, Globals::$CONFIG["config"]);
		foreach ($this->ziggeo->videos()->index(array("states" => "all")) as $video) {
            $this->ziggeo->videos()->delete($video["token"]);
        }
	}
		
	protected function setUp(): void {
		$this->init();
    }

    protected function tearDown(): void {
    	sleep(15);
    	$this->init();
    }		
	
}


