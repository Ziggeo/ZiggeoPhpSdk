<?php

Class ZiggeoAudioStreams {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function index($audio_token_or_key, $data = array()) {
    return $this->application->apiConnect()->getJSON('/v1/audios/' . $audio_token_or_key . '/streams', $data);
  }

  function get($audio_token_or_key, $token_or_key) {
    return $this->application->apiConnect()->getJSON('/v1/audios/' . $audio_token_or_key . '/streams/' . $token_or_key . '');
  }

  function download_audio($audio_token_or_key, $token_or_key) {
    return $this->application->jsCdnConnect()->get('/v1/audios/' . $audio_token_or_key . '/streams/' . $token_or_key . '/audio');
  }

  function delete($audio_token_or_key, $token_or_key) {
    return $this->application->apiConnect()->delete('/v1/audios/' . $audio_token_or_key . '/streams/' . $token_or_key . '');
  }

  function create($audio_token_or_key, $data = array()) {
    if (isset($data['file'])) {
        $result = $this->application->connect()->postUploadJSON('/v1/audios/' . $audio_token_or_key . '/streams-upload-url', 'stream', $data, 'audio_type');
        $result = $this->application->connect()->postJSON('/v1/audios/' . $audio_token_or_key . '/streams/' . $result['token'] . '/confirm-audio');
        return $result;
    } else
        return $this->application->apiConnect()->postJSON('/v1/audios/' . $audio_token_or_key . '/streams', $data);
  }

}