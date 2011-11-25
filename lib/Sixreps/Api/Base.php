<?php

/**
 * Sixreps_Api_Base
 */
abstract class Sixreps_Api_Base {

	/**
	 * API resource prefix, e.g. 'albums', 'users'.
	 */
	abstract function prefix();

	/**
	 * Set client.
	 */
	public function __construct(Sixreps_Client $client) {
		$this->client = $client;
	}

	/**
	 * Make API request.
	 *
	 * @see Sixreps_Api_Base::decryptResponse
	 * @param string $url
	 * @param array $attrs Array of parameters passed to URL
	 * @return stdClass JSON-decoded string as an object
	 */
	protected function makeRequest($url, $attrs = array(), $withToken = true, $decrypt = true, $method = 'GET') {
		$url = $this->client->host() . $url;

		if ($withToken === true) {
			$attrs = array_merge(
				(array)$attrs,
				array('access_token' => $this->client->accessToken())
			);
		}

		if (!empty($attrs)) {
			$url .= '?';
			foreach ($attrs as $param => $value) {
				$url .= $param . '=' .$value . '&';
			}
		}

		// Chop trailing '&' char
		$url = rtrim($url, '&');

		$request = curl_init($url);
		curl_setopt($request, CURLOPT_USERAGENT, $this->client->userAgent());
		curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($request, CURLOPT_CONNECTTIMEOUT, $this->client->connectTimeout());
		curl_setopt($request, CURLOPT_TIMEOUT, $this->client->timeout());
		$response = curl_exec($request);

		curl_close($request);

		if ($decrypt === false) {
			return $response;
		}
		return $this->decryptResponse($response);
	}

	/**
	 * Decrypt returned response from API request.
	 *
	 * @param string $response
	 * @return stdClass JSON-decoded string as an object
	 */
	public function decryptResponse($response) {
		$td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');

		$key =  "";
		$keySize = mcrypt_enc_get_key_size($td);
		for ($i = 0; $i < $keySize; $i++) {
			$key .= 'x';
		}
		$iv = substr($response, 0, mcrypt_enc_get_iv_size($td));

		mcrypt_generic_init($td, $key, $iv);
		$response = mdecrypt_generic($td, $response);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);

		// Remove all non-printable characters in response
		$response = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response);

		// Response is still a string, make it object
		return json_decode($response);
	}

}
