<?php

Class ZiggeoVideos {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function index($data = array()) {
    return $this->application->connect()->getJSON('/videos/', $data);
  }

  function count($data = array()) {
    return $this->application->connect()->getJSON('/videos/count', $data);
  }

  function get($token_or_key) {
    return $this->application->connect()->getJSON('/videos/' . $token_or_key . '');
  }

  function get_bulk($data = array()) {
    return $this->application->connect()->postJSON('/videos/get_bulk', $data);
  }

  function stats_bulk($data = array()) {
    return $this->application->connect()->postJSON('/videos/stats_bulk', $data);
  }

  function download_video($token_or_key) {
    return $this->application->connect()->get('/videos/' . $token_or_key . '/video');
  }

  function download_image($token_or_key) {
    return $this->application->connect()->get('/videos/' . $token_or_key . '/image');
  }

  function get_stats($token_or_key) {
    return $this->application->connect()->getJSON('/videos/' . $token_or_key . '/stats');
  }

  function push_to_service($token_or_key, $data = array()) {
    return $this->application->connect()->postJSON('/videos/' . $token_or_key . '/push', $data);
  }

  function apply_effect($token_or_key, $data = array()) {
    return $this->application->connect()->postJSON('/videos/' . $token_or_key . '/effect', $data);
  }

  function apply_meta($token_or_key, $data = array()) {
    return $this->application->connect()->postJSON('/videos/' . $token_or_key . '/metaprofile', $data);
  }

  function update($token_or_key, $data = array()) {
    return $this->application->connect()->postJSON('/videos/' . $token_or_key . '', $data);
  }

  function update_bulk($data = array()) {
    return $this->application->connect()->postJSON('/videos/update_bulk', $data);
  }

  function delete($token_or_key) {
    return $this->application->connect()->delete('/videos/' . $token_or_key . '');
  }

  function create($data = array()) {
    if (isset($data['file']))
      $data['file'] = '@' . $data['file'];
    return $this->application->connect()->postJSON('/videos/', $data);
  }

  function analytics($token_or_key, $data = array()) {
    return $this->application->connect()->postJSON('/videos/' . $token_or_key . '/analytics', $data);
  }

}