<?php

Class ZiggeoEffectProfileProcess {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function index($effect_token_or_key, $data = array()) {
    return $this->application->connect()->getJSON('/effects/' . $effect_token_or_key . '/process', $data);
  }

  function get($effect_token_or_key, $token_or_key) {
    return $this->application->connect()->getJSON('/effects/' . $effect_token_or_key . '/process/' . $token_or_key . '');
  }

  function delete($effect_token_or_key, $token_or_key) {
    return $this->application->connect()->delete('/effects/' . $effect_token_or_key . '/process/' . $token_or_key . '');
  }

  function create_filter_process($effect_token_or_key, $data = array()) {
    return $this->application->connect()->postJSON('/effects/' . $effect_token_or_key . '/process/filter', $data);
  }

  function create_watermark_process($effect_token_or_key, $data = array()) {
    if (isset($data['file']))
      $data['file'] = '@' . $data['file'];
    return $this->application->connect()->postJSON('/effects/' . $effect_token_or_key . '/process/watermark', $data);
  }

}