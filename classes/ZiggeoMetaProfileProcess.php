<?php

Class ZiggeoMetaProfileProcess {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function index($meta_token_or_key) {
    return $this->application->connect()->getJSON('/v1/metaprofiles/' . $meta_token_or_key . '/process');
  }

  function get($meta_token_or_key, $token_or_key) {
    return $this->application->connect()->getJSON('/v1/metaprofiles/' . $meta_token_or_key . '/process/' . $token_or_key . '');
  }

  function delete($meta_token_or_key, $token_or_key) {
    return $this->application->connect()->delete('/v1/metaprofiles/' . $meta_token_or_key . '/process/' . $token_or_key . '');
  }

  function create_video_analysis_process($meta_token_or_key) {
    return $this->application->connect()->postJSON('/v1/metaprofiles/' . $meta_token_or_key . '/process/analysis');
  }

  function create_audio_transcription_process($meta_token_or_key) {
    return $this->application->connect()->postJSON('/v1/metaprofiles/' . $meta_token_or_key . '/process/transcription');
  }

  function create_nsfw_process($meta_token_or_key, $data = array()) {
    return $this->application->connect()->postJSON('/v1/metaprofiles/' . $meta_token_or_key . '/process/nsfw', $data);
  }

  function create_profanity_process($meta_token_or_key, $data = array()) {
    return $this->application->connect()->postJSON('/v1/metaprofiles/' . $meta_token_or_key . '/process/profanity', $data);
  }

}