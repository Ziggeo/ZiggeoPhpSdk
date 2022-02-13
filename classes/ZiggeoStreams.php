<?php

Class ZiggeoStreams {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function index($video_token_or_key, $data = array()) {
    return $this->application->connect()->getJSON('/v1/videos/' . $video_token_or_key . '/streams', $data);
  }

  function get($video_token_or_key, $token_or_key) {
    return $this->application->connect()->getJSON('/v1/videos/' . $video_token_or_key . '/streams/' . $token_or_key . '');
  }

  function download_video($video_token_or_key, $token_or_key) {
    return $this->application->cdnConnect()->get('/v1/videos/' . $video_token_or_key . '/streams/' . $token_or_key . '/video');
  }

  function download_image($video_token_or_key, $token_or_key) {
    return $this->application->cdnConnect()->get('/v1/videos/' . $video_token_or_key . '/streams/' . $token_or_key . '/image');
  }

  function push_to_service($video_token_or_key, $token_or_key, $data = array()) {
    return $this->application->connect()->postJSON('/v1/videos/' . $video_token_or_key . '/streams/' . $token_or_key . '/push', $data);
  }

  function delete($video_token_or_key, $token_or_key) {
    return $this->application->connect()->delete('/v1/videos/' . $video_token_or_key . '/streams/' . $token_or_key . '');
  }

  function create($video_token_or_key, $data = array()) {
    if (isset($data['file'])) {
        $result = $this->application->connect()->postUploadJSON('/v1/videos/' . $video_token_or_key . '/streams-upload-url', 'stream', $data, 'video_type');
        $result = $this->application->connect()->postJSON('/v1/videos/' . $video_token_or_key . '/streams/' . $result['token'] . '/confirm-video');
        return $result;
    } else
        return $this->application->connect()->postJSON('/v1/videos/' . $video_token_or_key . '/streams', $data);
  }

  function attach_image($video_token_or_key, $token_or_key, $data = array()) {
    if (isset($data['file'])) {
        $result = $this->application->connect()->postUploadJSON('/v1/videos/' . $video_token_or_key . '/streams/' . $token_or_key . '/image-upload-url', 'stream', $data);
        $result = $this->application->connect()->postJSON('/v1/videos/' . $video_token_or_key . '/streams/' . $token_or_key . '/confirm-image');
        return $result;
    } else
        return $this->application->connect()->postJSON('/v1/videos/' . $video_token_or_key . '/streams/' . $token_or_key . '/image', $data);
  }

  function attach_video($video_token_or_key, $token_or_key, $data = array()) {
    if (isset($data['file'])) {
        $result = $this->application->connect()->postUploadJSON('/v1/videos/' . $video_token_or_key . '/streams/' . $token_or_key . '/video-upload-url', 'stream', $data, 'video_type');
        $result = $this->application->connect()->postJSON('/v1/videos/' . $video_token_or_key . '/streams/' . $token_or_key . '/confirm-video');
        return $result;
    } else
        return $this->application->connect()->postJSON('/v1/videos/' . $video_token_or_key . '/streams/' . $token_or_key . '/video', $data);
  }

  function attach_subtitle($video_token_or_key, $token_or_key, $data = array()) {
    return $this->application->connect()->postJSON('/v1/videos/' . $video_token_or_key . '/streams/' . $token_or_key . '/subtitle', $data);
  }

}