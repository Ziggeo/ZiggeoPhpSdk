<?php

Class ZiggeoWebhooks {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function create($data = array()) {
    return $this->application->connect()->post('/api/hook', $data);
  }

  function delete($data = array()) {
    return $this->application->connect()->post('/api/removehook', $data);
  }

}