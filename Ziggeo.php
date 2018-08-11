<?php

spl_autoload_register(function ($class) {
    $fname = dirname(__FILE__) . "/classes/" . $class . '.php';
    if (file_exists($fname))
        include $fname;
});

Class Ziggeo {

    private $token;
    private $private_key;
    private $encryption_key;

    function __construct($token, $private_key, $encryption_key = NULL) {
        $this->token = $token;
        $this->private_key = $private_key;
        $this->encryption_key = $encryption_key;
    }

    function token() {
        return $this->token;
    }

    function private_key() {
        return $this->private_key;
    }

    function encryption_key() {
        return $this->encryption_key;
    }


    private $config = NULL;

    function config() {
        if (!@$this->config)
            $this->config = new ZiggeoConfig($this);
        return $this->config;
    }


    private $connect = NULL;

    function connect() {
        if (!@$this->connect)
            $this->connect = new ZiggeoConnect($this);
        return $this->connect;
    }


    private $auth = NULL;

    function auth() {
        if (!@$this->auth)
            $this->auth = new ZiggeoAuth($this);
        return $this->auth;
    }


    private $videos = NULL;

    function videos() {
        if (!@$this->videos)
            $this->videos = new ZiggeoVideos($this);
        return $this->videos;
    }


    private $streams = NULL;

    function streams() {
        if (!@$this->streams)
            $this->streams = new ZiggeoStreams($this);
        return $this->streams;
    }


    private $authtokens = NULL;

    function authtokens() {
        if (!@$this->authtokens)
            $this->authtokens = new ZiggeoAuthtokens($this);
        return $this->authtokens;
    }


    private $effectProfiles = NULL;

    function effectProfiles() {
        if (!@$this->effectProfiles)
            $this->effectProfiles = new ZiggeoEffectProfiles($this);
        return $this->effectProfiles;
    }


    private $effectProfileProcess = NULL;

    function effectProfileProcess() {
        if (!@$this->effectProfileProcess)
            $this->effectProfileProcess = new ZiggeoEffectProfileProcess($this);
        return $this->effectProfileProcess;
    }


    private $metaProfiles = NULL;

    function metaProfiles() {
        if (!@$this->metaProfiles)
            $this->metaProfiles = new ZiggeoMetaProfiles($this);
        return $this->metaProfiles;
    }


    private $metaProfileProcess = NULL;

    function metaProfileProcess() {
        if (!@$this->metaProfileProcess)
            $this->metaProfileProcess = new ZiggeoMetaProfileProcess($this);
        return $this->metaProfileProcess;
    }


    private $webhooks = NULL;

    function webhooks() {
        if (!@$this->webhooks)
            $this->webhooks = new ZiggeoWebhooks($this);
        return $this->webhooks;
    }


    private $analytics = NULL;

    function analytics() {
        if (!@$this->analytics)
            $this->analytics = new ZiggeoAnalytics($this);
        return $this->analytics;
    }


}
