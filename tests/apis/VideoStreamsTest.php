<?php

require_once(dirname(__FILE__) . "/../app/ServerApiTestCase.php");
require_once(dirname(__FILE__) . "/../../classes/ZiggeoException.php");

class VideoStreamsTest extends ServerApiTestCase {
	
	protected $video = NULL;
	
	protected function setUp(): void {
		parent::setUp();
		$this->video = $this->ziggeo->videos()->create();
    }
	
	public function testCreate1() {
		$stream = $this->ziggeo->streams()->create($this->video["token"], array("file" => Globals::$VIDEO_FILE));
        $limit = 100;
        while (($this->ziggeo->streams()->get($this->video["token"], $stream["token"]))["state_string"] != "READY" && $limit-- > 0)
            sleep(5);
        $stream = $this->ziggeo->streams()->get($this->video["token"], $stream["token"]);
		$this->assertEquals($stream["creation_type_string"], "SERVER_UPLOAD");
		$this->assertEquals($stream["streamable_string"], "DEGRADED");
		$this->assertEquals($stream["state_string"], "READY");
	}

	public function testCreate2() {
		$stream = $this->ziggeo->streams()->create($this->video["token"], array("file" => Globals::$NOVIDEO_FILE));
        $limit = 100;
        while (($this->ziggeo->videos()->get($this->video["token"]))["state_string"] != "FAILED" && $limit-- > 0)
            sleep(5);
        $video = $this->ziggeo->videos()->get($this->video["token"]);
        $this->assertEquals($video["state_string"], "FAILED");
	}

}
