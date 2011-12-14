<?php
/**
 * Sixreps - Official Sixreps PHP SDK
 *
 * @author Sixreps
 */

/**
 * Sixreps_Api_Oauth
 *
 * Maps request to oauth API resource served by main Sixreps API server
 *
 * @package Sixreps
 * @subpackage Sixreps.Api
 */
class Sixreps_Api_Oauth extends Sixreps_Api_Base {

    /**
     * API resource prefix
     *
     * @return string Prefix name of oauth API resource
     */
    public function prefix() {
        return 'oauth';
    }

    /**
     * Authorize client app.
     *
     * @return stdClass JSON-decoded response returned from API request
     */
    public function authorize() {
        $url = $this->prefix() . '/authorize';
        $attrs = array(
            'app_id'       => $this->client->appId(),
            'redirect_uri' => $this->client->redirectUri()
        );
        return $this->makeRequest($url, $attrs, false, false);
    }

    /**
     * Get access token for specific client.
     *
     * @param string $code Code that retrieved from authorization process
     * @return stdClass JSON-decoded response returned from API request
     */
    public function accessToken($code) {
        $url = $this->prefix() . '/access_token';
        $attrs = array(
            'code'         => $code,
            'app_id'       => $this->client->appId(),
            'redirect_uri' => $this->client->redirectUri(),
            'app_secret'   => $this->client->appSecret()
        );
        return $this->makeRequest($url, $attrs, false, false);
    }

}
