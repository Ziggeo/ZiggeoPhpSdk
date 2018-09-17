<?php

Class ZiggeoWebhooks {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function create($data = array()) {
    return $this->application->connect()->post('/v1/api/hook', $data);
  }

  function delete($data = array()) {
    return $this->application->connect()->post('/v1/api/removehook', $data);
  }

}