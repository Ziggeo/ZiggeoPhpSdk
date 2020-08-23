<?php

Class ZiggeoVideos {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function index($data = array()) {
    return $this->application->connect()->getJSON('/v1/videos/', $data);
  }

  function count($data = array()) {
    return $this->application->connect()->getJSON('/v1/videos/count', $data);
  }

  function get($token_or_key) {
    return $this->application->connect()->getJSON('/v1/videos/' . $token_or_key . '');
  }

  function get_bulk($data = array()) {
    return $this->application->connect()->postJSON('/v1/videos/get_bulk', $data);
  }

  function stats_bulk($data = array()) {
    return $this->application->connect()->postJSON('/v1/videos/stats_bulk', $data);
  }

  function download_video($token_or_key) {
    return $this->application->cdnConnect()->get('/v1/videos/' . $token_or_key . '/video');
  }

  function download_image($token_or_key) {
    return $this->application->cdnConnect()->get('/v1/videos/' . $token_or_key . '/image');
  }

  function get_stats($token_or_key) {
    return $this->application->connect()->getJSON('/v1/videos/' . $token_or_key . '/stats');
  }

  function push_to_service($token_or_key, $data = array()) {
    return $this->application->connect()->postJSON('/v1/videos/' . $token_or_key . '/push', $data);
  }

  function apply_effect($token_or_key, $data = array()) {
    return $this->application->connect()->postJSON('/v1/videos/' . $token_or_key . '/effect', $data);
  }

  function apply_meta($token_or_key, $data = array()) {
    return $this->application->connect()->postJSON('/v1/videos/' . $token_or_key . '/metaprofile', $data);
  }

  function update($token_or_key, $data = array()) {
    return $this->application->connect()->postJSON('/v1/videos/' . $token_or_key . '', $data);
  }

  function update_bulk($data = array()) {
    return $this->application->connect()->postJSON('/v1/videos/update_bulk', $data);
  }

  function delete($token_or_key) {
    return $this->application->connect()->delete('/v1/videos/' . $token_or_key . '');
  }

  function create($data = array()) {
    if (isset($data['file'])) {
        $result = $this->application->connect()->postUploadJSON("/v1/videos-upload-url/", "video", $data, "video_type");
        $result['default_stream'] = $this->application->connect()->postJSON('/v1/videos/' . $result['token'] . '/streams/' . $result['default_stream']['token'] . '/confirm-video');
        return $result;
    } else
        return $this->application->connect()->postJSON('/v1/videos/', $data);
  }

  function analytics($token_or_key, $data = array()) {
    return $this->application->connect()->postJSON('/v1/videos/' . $token_or_key . '/analytics', $data);
  }

}