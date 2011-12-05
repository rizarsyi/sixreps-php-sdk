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

	protected $appId = null;

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
	 * @param int $appId Client app ID
	 * @param int $appSecret Client app secret key
	 * @return void
	 */
	public function __construct($appId, $appSecret) {
		$this->appId     = $appId;
		$this->appSecret = $appSecret;
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
	 * @param int|null $appId Client app ID
	 * @return int|null Client app ID
	 */
	public function appId($appId = null) {
		if ($appId) {
			$this->appId = $appId;
		}
		return $this->appId;
	}

	/**
	 * Set and/or get app secret key.
	 *
	 * @param string|null $appSecret Client app secret key
	 * @return string|null Client app secret key
	 */
	public function appSecret($appSecret = null) {
		if ($appSecret) {
			$this->appSecret = $appSecret;
		}
		return $this->appSecret;
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
