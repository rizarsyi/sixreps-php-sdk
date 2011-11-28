<?php
/**
 * Sixreps - Official Sixreps PHP SDK
 *
 * @author Sixreps
 */

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
 *
 * Client app that requesting and retrieving response from API server
 *
 * @package Sixreps
 */
class Sixreps_Client {

	protected $clientId = null;

	/**
	 * Redirect URI when after client app has been authorized or retrieving access token.
	 *
	 * @var string
	 */
	protected $redirectUri = null;

	/**
	 * Host name that serves API resources.
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

	/**
	 * Access token
	 *
	 * @var string
	 */
	protected $accessToken = null;

	/**
	 * Connection timeout
	 *
	 * @var int
	 */
	protected $connectTimeout = 10;

	/**
	 * Timeout
	 *
	 * @var string
	 */
	protected $timeout = 60;

	/**
	 * Initializes client app
	 *
	 * @param int $clientId Client app ID
	 * @return void
	 */
	public function __construct($clientId) {
		$this->clientId = $clientId;
	}

	/**
	 * Get UserAgent name.
	 *
	 * @return string UserAgent name
	 */
	public function userAgent() {
		return $this->userAgent;
	}

	/**
	 * Get host name that serves API resources.
	 *
	 * @return string Connection timeout length in seconds
	 */
	public function host() {
		return $this->host;
	}

	/**
	 * Set and/or get access token when requesting resource from API server.
	 *
	 * @param string|null $accessToken Access token
	 * @return string|null Access token
	 */
	public function accessToken($accessToken = null) {
		if ($accessToken) {
			$this->accessToken = $accessToken;
		}
		return $this->accessToken;
	}

	/**
	 * Set and/or get timeout when connecting to API server.
	 *
	 * @param int $timeout Connection timeout length in seconds
	 * @return int Connection timeout length in seconds
	 */
	public function connectTimeout($connectTimeout = null) {
		if ($connectTimeout) {
			$this->connectTimeout = $connectTimeout;
		}
		return $this->connectTimeout;
	}

	/**
	 * Set and/or get timeout when retrieving response.
	 *
	 * @param int $timeout Timeout length in seconds
	 * @return int Timeout length in seconds
	 */
	public function timeout($timeout = null) {
		if ($timeout) {
			$this->timeout = $timeout;
		}
		return $this->timeout;
	}

	/**
	 * Set and/or get redirect URI.
	 *
	 * @param string|null $redirectUri Redirect URI used by client app
	 * @return string|null Redirect URI used by client app
	 */
	public function redirectUri($redirectUri = null) {
		if ($redirectUri) {
			$this->redirectUri = $redirectUri;
		}
		return $this->redirectUri;
	}

	/**
	 * Set and/or get client ID.
	 *
	 * @param int|null $clientId Client app ID
	 * @return int|null Client app ID
	 */
	public function clientId($clientId = null) {
		if ($clientId) {
			$this->clientId = $clientId;
		}
		return $this->clientId;
	}

	/**
	 * Automatically load classes under Sixreps package.
	 *
	 * @param string $class Class name
	 * @return void
	 */
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
