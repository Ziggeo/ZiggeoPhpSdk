<?php

Class ZiggeoAudios {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function index($data = array()) {
    return $this->application->apiConnect()->getJSON('/v1/audios/', $data);
  }

  function count($data = array()) {
    return $this->application->apiConnect()->getJSON('/v1/audios/count', $data);
  }

  function get($token_or_key) {
    return $this->application->apiConnect()->getJSON('/v1/audios/' . $token_or_key . '');
  }

  function get_bulk($data = array()) {
    return $this->application->apiConnect()->postJSON('/v1/audios/get-bulk', $data);
  }

  function download_audio($token_or_key) {
    return $this->application->jsCdnConnect()->get('/v1/audios/' . $token_or_key . '/audio');
  }

  function update($token_or_key, $data = array()) {
    return $this->application->apiConnect()->postJSON('/v1/audios/' . $token_or_key . '', $data);
  }

  function update_bulk($data = array()) {
    return $this->application->apiConnect()->postJSON('/v1/audios/update-bulk', $data);
  }

  function delete($token_or_key) {
    return $this->application->apiConnect()->delete('/v1/audios/' . $token_or_key . '');
  }

  function create($data = array()) {
    if (isset($data['file'])) {
        $result = $this->application->connect()->postUploadJSON('/v1/audios-upload-url', 'audio', $data, 'audio_type');
        $result['default_stream'] = $this->application->connect()->postJSON('/v1/audios/' . $result['token'] . '/streams/' . $result['default_stream']['token'] . '/confirm-audio');
        return $result;
    } else
        return $this->application->apiConnect()->postJSON('/v1/audios/', $data);
  }

}