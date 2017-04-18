<?php

Class ZiggeoEffectProfiles {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function create($data = array()) {
    return $this->application->connect()->postJSON('/effects/', $data);
  }

  function index($data = array()) {
    return $this->application->connect()->getJSON('/effects/', $data);
  }

  function get($token_or_key) {
    return $this->application->connect()->getJSON('/effects/' . $token_or_key . '');
  }

  function delete($token_or_key) {
    return $this->application->connect()->delete('/effects/' . $token_or_key . '');
  }

}