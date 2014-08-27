<?php

Class ZiggeoAuth {

	protected $application;
	protected $cipher;

	function __construct($application) {
		$this->application = $application;
		$this->cipher = NULL;
	}
	
	protected function encrypt($plaintext) {
		if ($this->cipher == NULL) {
			$hash = new Crypt_Hash('md5');
			$hashed_key = bin2hex($hash->hash($this->application->encryption_key()));
			$this->cipher = new Crypt_AES(CRYPT_AES_MODE_CBC);
			$this->cipher->setKeyLength(256);
			$this->cipher->setKey($hashed_key);
		}
		$iv = "";
		for ($i = 0; $i < 8; $i++)
			$iv .= chr(mt_rand(0,255));
		$iv = bin2hex($iv);		
		$this->cipher->setIV($iv);
		return $iv . bin2hex($this->cipher->encrypt($plaintext));
	}

	function generate($options = array()) {
		$data = array_merge(array(
			"application_token" => $this->application->token(),
			"nonce" => $this->generateNonce()
		), $options);
		return $this->encrypt(json_encode($data));
	}
	
	private function generateNonce() {
		return time() . "" . rand(0, PHP_INT_MAX);
	}

}
