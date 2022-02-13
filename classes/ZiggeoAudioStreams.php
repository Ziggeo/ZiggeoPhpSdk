<?php

Class ZiggeoAudio_streams {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function index($audio_token_or_key, $data = array()) {
    return $this->application->apiConnect()->getJSON('/server/v1/audios/bytoken/' . $audio_token_or_key . '/streams', $data);
  }

  function get($audio_token_or_key, $token_or_key) {
    return $this->application->apiConnect()->getJSON('/server/v1/audios/bytoken/' . $audio_token_or_key . '/streams/bytoken/' . $token_or_key . '');
  }

  function download_audio($audio_token_or_key, $token_or_key) {
    return $this->application->connect()->get('/v1/server/v1/audios/bytoken/' . $audio_token_or_key . '/streams/bytoken/' . $token_or_key . '/audio');
  }

  function delete($audio_token_or_key, $token_or_key) {
    return $this->application->apiConnect()->delete('/server/v1/audios/bytoken/' . $audio_token_or_key . '/streams/bytoken/' . $token_or_key . '');
  }

  function create($audio_token_or_key, $data = array()) {
    if (isset($data['file'])) {
        $result = $this->application->connect()->postUploadJSON('/server/v1/audios/' . $video_token_or_key . '/streams-upload-url', 'stream', $data, 'video_type');
        $result = $this->application->connect()->postJSON('/server/v1/audios/' . $video_token_or_key . '/streams/' . $result['token'] . '/confirm-video');
        return $result;
    } else
        return $this->application->apiConnect()->postJSON('/server/v1/audios/bytoken/' . $audio_token_or_key . '/streams', $data);
  }

}