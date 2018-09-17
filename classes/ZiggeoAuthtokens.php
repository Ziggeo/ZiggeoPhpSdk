<?php

Class ZiggeoAuthtokens {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function get($token) {
    return $this->application->connect()->getJSON('/v1/authtokens/' . $token . '');
  }

  function update($token_or_key, $data = array()) {
    return $this->application->connect()->postJSON('/v1/authtokens/' . $token_or_key . '', $data);
  }

  function delete($token_or_key) {
    return $this->application->connect()->delete('/v1/authtokens/' . $token_or_key . '');
  }

  function create($data = array()) {
    return $this->application->connect()->postJSON('/v1/authtokens/', $data);
  }

}