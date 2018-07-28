<?php

require_once(dirname(__FILE__) . "/../app/ServerApiTestCase.php");

class VideoStreamsTest extends ServerApiTestCase {
	
	protected $video = NULL;
	
	protected function setUp() {
		parent::setUp();
		$this->video = $this->ziggeo->videos()->create();
    }
	
	public function testCreate1() {
		$stream = $this->ziggeo->streams()->create($this->video->token, array("file" => Globals::$VIDEO_FILE));
		$this->assertEquals($stream->creation_type_string, "SERVER_UPLOAD");
		$this->assertEquals($stream->streamable_string, "DEGRADED");
		$this->assertEquals($stream->state_string, "READY");
	}

	/**
     * @expectedException ZiggeoException
     */
	public function testCreate2() {
		$stream = $this->ziggeo->streams()->create($this->video->token, array("file" => Globals::$NOVIDEO_FILE));
	}

}
