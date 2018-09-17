<?php

Class ZiggeoMetaProfiles {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function create($data = array()) {
    return $this->application->connect()->postJSON('/v1/metaprofiles/', $data);
  }

  function index($data = array()) {
    return $this->application->connect()->getJSON('/v1/metaprofiles/', $data);
  }

  function get($token_or_key) {
    return $this->application->connect()->getJSON('/v1/metaprofiles/' . $token_or_key . '');
  }

  function delete($token_or_key) {
    return $this->application->connect()->delete('/v1/metaprofiles/' . $token_or_key . '');
  }

}