<?php

Class ZiggeoVideos {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function index($data = array()) {
    return $this->application->connect()->getJSON('/videos/', $data);
  }

  function get($token_or_key) {
    return $this->application->connect()->getJSON('/videos/' . $token_or_key . '');
  }

  function download_video($token_or_key) {
    return $this->application->connect()->get('/videos/' . $token_or_key . '/video');
  }

  function download_image($token_or_key) {
    return $this->application->connect()->get('/videos/' . $token_or_key . '/image');
  }

  function update($token_or_key, $data = array()) {
    return $this->application->connect()->postJSON('/videos/' . $token_or_key . '', $data);
  }

  function delete($token_or_key) {
    return $this->application->connect()->delete('/videos/' . $token_or_key . '');
  }

  function create($data = array()) {
    if (isset($data['file']))
      $data['file'] = '@' . $data['file'];
    return $this->application->connect()->postJSON('/videos/', $data);
  }

}