<?php

Class ZiggeoApplication {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function get() {
    return $this->application->connect()->getJSON('/v1/application');
  }

  function update($data = array()) {
    return $this->application->connect()->postJSON('/v1/application', $data);
  }

  function get_stats($data = array()) {
    return $this->application->apiConnect()->getJSON('/server/v1/application/stats', $data);
  }

}