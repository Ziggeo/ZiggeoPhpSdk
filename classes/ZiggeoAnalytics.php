<?php

Class ZiggeoAnalytics {

  protected $application;

  function __construct($application) {
    $this->application = $application;
  }

  function get($data = array()) {
    return $this->application->connect()->postJSON('/analytics/get', $data);
  }

}