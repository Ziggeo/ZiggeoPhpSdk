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

    function __construct($token, $private_key, $encryption_key = null, $config = null) {
        $this->token = $token;
        $this->private_key = $private_key;
        $this->encryption_key = $encryption_key;
        if (is_array($config)) {
            foreach($config as $ident => $value)
                $this->config()->set($ident, $value);
        }
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

    private $config = null;

    function config() {
        if ($this->config === null)
            $this->config = new ZiggeoConfig($this);
        return $this->config;
    }


    private $connect = null;

    function connect() {
        if ($this->connect === null) {
            $server_api_url = $this->config()->get("server_api_url");
            $regions = $this->config()->get("regions");
            foreach ($regions as $key => $value)
                if (strpos($this->token(), $key) === 0)
                    $server_api_url = $value;
            $this->connect = new ZiggeoConnect($this, $server_api_url, $this->config());
        }
        return $this->connect;
    }


    private $apiConnect = null;

    function apiConnect() {
        if ($this->apiConnect === null) {
            $api_url = $this->config()->get("api_url");
            $api_regions = $this->config()->get("api_regions");
            foreach ($api_regions as $key => $value)
                if (strpos($this->token(), $key) === 0)
                    $api_url = $value;
            $this->apiConnect = new ZiggeoConnect($this, $api_url, $this->config());
        }
        return $this->apiConnect;
    }

    private $cdnConnect = null;

    function cdnConnect() {
        if ($this->cdnConnect === null) {
            $cdn_url = $this->config()->get("cdn_url");
            $cdn_regions = $this->config()->get("cdn_regions");
            foreach ($cdn_regions as $key => $value)
                if (strpos($this->token(), $key) === 0)
                    $cdn_url = $value;
            $this->cdnConnect = new ZiggeoConnect($this, $cdn_url, $this->config());
        }
        return $this->cdnConnect;
    }

		private $jsCdnConnect = null;

		function jsCdnConnect() {
				if ($this->jsCdnConnect === null) {
						$jsCdn_url = $this->config()->get("js_cdn_url");
						$jsCdn_regions = $this->config()->get("js_cdn_regions");
						foreach ($jsCdn_regions as $key => $value)
								if (strpos($this->token(), $key) === 0)
										$jsCdn_url = $value;
						$this->jsCdnConnect = new ZiggeoConnect($this, $jsCdn_url, $this->config());
				}
			return $this->jsCdnConnect;
		}

    private $auth = null;

    function auth() {
        if ($this->auth === null)
            $this->auth = new ZiggeoAuth($this);
        return $this->auth;
    }


    private $videos = null;

    function videos() {
        if ($this->videos === null)
            $this->videos = new ZiggeoVideos($this);
        return $this->videos;
    }


    private $streams = null;

    function streams() {
        if ($this->streams === null)
            $this->streams = new ZiggeoStreams($this);
        return $this->streams;
    }


    private $audios = null;

    function audios() {
        if ($this->audios === null)
            $this->audios = new ZiggeoAudios($this);
        return $this->audios;
    }


    private $audioStreams = null;

    function audioStreams() {
        if ($this->audioStreams === null)
            $this->audioStreams = new ZiggeoAudioStreams($this);
        return $this->audioStreams;
    }


    private $authtokens = null;

    function authtokens() {
        if ($this->authtokens === null)
            $this->authtokens = new ZiggeoAuthtokens($this);
        return $this->authtokens;
    }


    private $application = null;

    function application() {
        if ($this->application === null)
            $this->application = new ZiggeoApplication($this);
        return $this->application;
    }


    private $effectProfiles = null;

    function effectProfiles() {
        if ($this->effectProfiles === null)
            $this->effectProfiles = new ZiggeoEffectProfiles($this);
        return $this->effectProfiles;
    }


    private $effectProfileProcess = null;

    function effectProfileProcess() {
        if ($this->effectProfileProcess === null)
            $this->effectProfileProcess = new ZiggeoEffectProfileProcess($this);
        return $this->effectProfileProcess;
    }


    private $metaProfiles = null;

    function metaProfiles() {
        if ($this->metaProfiles === null)
            $this->metaProfiles = new ZiggeoMetaProfiles($this);
        return $this->metaProfiles;
    }


    private $metaProfileProcess = null;

    function metaProfileProcess() {
        if ($this->metaProfileProcess === null)
            $this->metaProfileProcess = new ZiggeoMetaProfileProcess($this);
        return $this->metaProfileProcess;
    }


    private $webhooks = null;

    function webhooks() {
        if ($this->webhooks === null)
            $this->webhooks = new ZiggeoWebhooks($this);
        return $this->webhooks;
    }


    private $analytics = null;

    function analytics() {
        if ($this->analytics === null)
            $this->analytics = new ZiggeoAnalytics($this);
        return $this->analytics;
    }


}
