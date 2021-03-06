<?php

Class ZiggeoEffectProfileProcess {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function index($effect_token_or_key, $data = array()) {
    return $this->application->connect()->getJSON('/v1/effects/' . $effect_token_or_key . '/process', $data);
  }

  function get($effect_token_or_key, $token_or_key) {
    return $this->application->connect()->getJSON('/v1/effects/' . $effect_token_or_key . '/process/' . $token_or_key . '');
  }

  function delete($effect_token_or_key, $token_or_key) {
    return $this->application->connect()->delete('/v1/effects/' . $effect_token_or_key . '/process/' . $token_or_key . '');
  }

  function create_filter_process($effect_token_or_key, $data = array()) {
    return $this->application->connect()->postJSON('/v1/effects/' . $effect_token_or_key . '/process/filter', $data);
  }

  function create_watermark_process($effect_token_or_key, $data = array()) {
    if (isset($data['file'])) {
        $result = $this->application->connect()->postUploadJSON('/v1/effects/' . $effect_token_or_key . '/process/watermark-upload-url', 'effect_process', $data);
        $result = $this->application->connect()->postJSON('/v1/effects/' . $effect_token_or_key . '/process/' . $result['token'] . '/confirm-watermark');
        return $result;
    } else
        return $this->application->connect()->postJSON('/v1/effects/' . $effect_token_or_key . '/process/watermark', $data);
  }

  function edit_watermark_process($effect_token_or_key, $token_or_key, $data = array()) {
    if (isset($data['file'])) {
        $result = $this->application->connect()->postUploadJSON('/v1/effects/' . $effect_token_or_key . '/process/' . $token_or_key . '/watermark-upload-url', 'effect_process', $data);
        $result = $this->application->connect()->postJSON('/v1/effects/' . $effect_token_or_key . '/process/' . $token_or_key . '/confirm-watermark');
        return $result;
    } else
        return $this->application->connect()->postJSON('/v1/effects/' . $effect_token_or_key . '/process/watermark/' . $token_or_key . '', $data);
  }

}