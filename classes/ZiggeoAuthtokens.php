<?php

Class ZiggeoAuthtokens {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function get($token) {
    return $this->application->connect()->getJSON('/authtokens/' . $token . '');
  }

  function update($token_or_key, $data = array()) {
    return $this->application->connect()->postJSON('/authtokens/' . $token_or_key . '', $data);
  }

  function delete($token_or_key) {
    return $this->application->connect()->delete('/authtokens/' . $token_or_key . '');
  }

  function create($data = array()) {
    return $this->application->connect()->postJSON('/authtokens/', $data);
  }

}