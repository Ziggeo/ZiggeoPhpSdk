<?php

Class ZiggeoAudios {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function index($data = array()) {
    return $this->application->apiConnect()->getJSON('/server/v1/audios/', $data);
  }

  function count($data = array()) {
    return $this->application->apiConnect()->getJSON('/server/v1/audios/count', $data);
  }

  function get($token_or_key) {
    return $this->application->apiConnect()->getJSON('/server/v1/audios/bytoken/' . $token_or_key . '');
  }

  function get_bulk($data = array()) {
    return $this->application->apiConnect()->postJSON('/server/v1/audios/get-bulk', $data);
  }

  function download_audio($token_or_key) {
    return $this->application->connect()->get('/v1/server/v1/audios/bytoken/' . $token_or_key . '/video');
  }

  function update($token_or_key, $data = array()) {
    return $this->application->apiConnect()->postJSON('/server/v1/audios/bytoken/' . $token_or_key . '', $data);
  }

  function update_bulk($data = array()) {
    return $this->application->apiConnect()->postJSON('/server/v1/audios/update-bulk', $data);
  }

  function delete($token_or_key) {
    return $this->application->apiConnect()->delete('/server/v1/audios/bytoken/' . $token_or_key . '');
  }

  function create($data = array()) {
    if (isset($data['file'])) {
        $result = $this->application->connect()->postUploadJSON('/server/v1/audios/audios-upload-url', 'audio', $data, 'audio_type');
        $result['default_stream'] = $this->application->connect()->postJSON('/server/v1/audios/' . $result['token'] . '/streams/' . $result['default_stream']['token'] . '/confirm-audio');
        return $result;
    } else
        return $this->application->apiConnect()->postJSON('/server/v1/audios/', $data);
  }

}