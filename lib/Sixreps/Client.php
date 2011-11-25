<?php

// Throws exception if Mcrypt extension is not loaded
if (!extension_loaded('mcrypt')) {
	throw new RuntimeException("Sixreps needs the Mcrypt PHP extension.");
}

// Throws exception if CURL extension is not loaded
if (!function_exists('curl_init')) {
	throw new RuntimeException('Sixreps needs the CURL PHP extension.');
}

// Throws exception if JSON extension is not loaded
if (!function_exists('json_decode')) {
	throw new RuntimeException('Sixreps needs the JSON PHP extension.');
}

// Tells PHP to auto-load classes using Sixreps_Client's autoloader.
spl_autoload_register(array('Sixreps_Client', 'autoload'));

/**
 * Sixreps_Client
 */
class Sixreps_Client {

	protected $clientId = null;

	protected $redirectUri = null;

	/**
	 * Domain that serves API resources
	 *
	 * @var string
	 */
	protected $host = 'http://api.sixreps.dev/';

	/**
	 * UserAgent name
	 *
	 * @var string
	 */
	protected $userAgent = 'sixreps-php-0.1';

	protected $accessToken = null;

	protected $connectTimeout = 10;

	protected $timeout = 60;

	public function __construct($clientId) {
		$this->clientId = $clientId;
	}

	public function accessToken($accessToken = null) {
		if ($accessToken) {
			$this->accessToken = $accessToken;
		}
		return $this->accessToken;
	}

	public function userAgent() {
		return $this->userAgent;
	}

	public function host() {
		return $this->host;
	}

	public function connectTimeout($connectTimeout = null) {
		if ($connectTimeout) {
			$this->connectTimeout = $connectTimeout;
		}
		return $this->connectTimeout;
	}

	public function timeout($timeout = null) {
		if ($timeout) {
			$this->timeout = $timeout;
		}
		return $this->timeout;
	}

	public static function autoload($class) {
		if (strpos($class, 'Sixreps') !== 0) {
			return;
		}

		// Exclude Sixreps namespace
		$file = str_replace('_', DIRECTORY_SEPARATOR, substr($class, 8));
		$file = dirname(__FILE__) . DIRECTORY_SEPARATOR . $file . '.php';
		if (file_exists($file)) {
			require $file;
		}
	}

}
