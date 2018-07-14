<?php

Class ZiggeoMetaProfiles {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function create($data = array()) {
    return $this->application->connect()->postJSON('/metaprofiles/', $data);
  }

  function index($data = array()) {
    return $this->application->connect()->getJSON('/metaprofiles/', $data);
  }

  function get($token_or_key) {
    return $this->application->connect()->getJSON('/metaprofiles/' . $token_or_key . '');
  }

  function delete($token_or_key) {
    return $this->application->connect()->delete('/metaprofiles/' . $token_or_key . '');
  }

}