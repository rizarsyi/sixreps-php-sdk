<?php

/**
 * Sixreps_Api_Oauth
 */
class Sixreps_Api_Oauth extends Sixreps_Api_Base {

	public function prefix() {
		return 'oauth';
	}

	public function authorize() {
		$url = $this->prefix() . '/authorize';
		$attrs = array(
			'client_id'    => $this->client->clientId,
			'redirect_uri' => $this->client->redirectUri
		);
		return $this->makeRequest($url, $attrs);
	}

}
