<?php

require_once(dirname(__FILE__) . "/../app/ServerApiTestCase.php");

class VideosTest extends ServerApiTestCase {

	public function testCreate1() {
		$video = $this->ziggeo->videos()->create(array("max_duration" => 10, "key" => "test"));
		$this->assertEquals($video["key"], "test");
		$this->assertEquals($video["max_duration"], 10);
		$this->assertEquals(count($this->ziggeo->videos()->index(array("states" => "all"))), 1);
		$this->assertEquals(count($this->ziggeo->videos()->index(array("states" => "ready"))), 0);
		$video = $this->ziggeo->videos()->get($video["token"]);
        $this->assertEquals(count($this->ziggeo->videos()->index(array("states" => "all", "tags" => "foobar"))), 0);
		$this->ziggeo->videos()->update("_test", array("tags" => "foobar", "data" => json_encode(array("test" => 1234))));
		$this->ziggeo->videos()->update("_test", array("data" => json_encode(array("test" => 5678))));
        $this->assertEquals(count($this->ziggeo->videos()->index(array("states" => "all", "tags" => "foobar"))), 1);
		$this->assertTrue($video != NULL);
		$video = $this->ziggeo->videos()->get("_test");
		$this->assertTrue($video != NULL);
		$this->assertEquals($video["tags"][0], "foobar");
		$this->assertEquals($video["data"]["test"], 5678);
		$this->ziggeo->videos()->delete("_test");
		$this->assertEquals(count($this->ziggeo->videos()->index(array("states" => "all"))), 0);
	}

	public function testCreate2() {
		$video = $this->ziggeo->videos()->create(array("file" => Globals::$VIDEO_FILE));
		$limit = 100;
        while (($this->ziggeo->videos()->get($video["token"]))["state_string"] != "READY" && $limit-- > 0)
            sleep(5);
        $video = $this->ziggeo->videos()->get($video["token"]);
		$this->assertEquals($video["original_stream"]["creation_type_string"], "SERVER_UPLOAD");
		$this->assertEquals($video["original_stream"]["streamable_string"], "DEGRADED");
		$this->assertEquals($video["original_stream"]["state_string"], "READY");
        while (($this->ziggeo->videos()->get($video["token"]))["default_stream"]["creation_type_string"] != "TRANSCODED" && $limit-- > 0)
            sleep(5);
        $video = $this->ziggeo->videos()->get($video["token"]);
        $this->assertEquals($video["default_stream"]["creation_type_string"], "TRANSCODED");
        $this->assertEquals($video["default_stream"]["streamable_string"], "YES");
        $this->assertEquals($video["default_stream"]["state_string"], "READY");
	}

	public function testCreate3() {
		$video = $this->ziggeo->videos()->create(array("file" => Globals::$NOVIDEO_FILE));
        $limit = 100;
        while (($this->ziggeo->videos()->get($video["token"]))["state_string"] != "FAILED" && $limit-- > 0)
            sleep(5);
        $video = $this->ziggeo->videos()->get($video["token"]);
        $this->assertEquals($video["state_string"], "FAILED");
	}

}
