<?php
/**
 * Sixreps - Official Sixreps PHP SDK
 *
 * @author Sixreps
 */

/**
 * Sixreps_Api_Photo
 *
 * Maps request to photos API resource served by main Sixreps API server
 *
 * @package Sixreps
 * @subpackage Sixreps.Api
 */
class Sixreps_Api_Photo extends Sixreps_Api_Base {

    /**
     * API resource prefix
     *
     * @return string Prefix name of photos API resource
     */
    public function prefix() {
        return 'photos';
    }

    /**
     * Get specific photo.
     *
     * @param int $id Photo ID
     * @param array $attrs An array of parameters passed to request URI
     * @return stdClass JSON-decoded response returned from API request
     */
    public function getPhoto($id, $attrs = array()) {
        $url = $this->prefix() . '/' . urlencode($id);
        return $this->makeRequest($url, $attrs);
    }

    /**
     * Get all comments for specific photo.
     *
     * @param int $id Photo ID
     * @param array $attrs An array of parameters passed to request URI
     * @return stdClass JSON-decoded response returned from API request
     */
    public function getComments($id, $attrs = array()) {
        $url = $this->prefix() . '/' . urlencode($id) . '/comments';
        return $this->makeRequest($url, $attrs);
    }

    /**
     * Get all likes for specific photo.
     *
     * @param int $id Photo ID
     * @param array $attrs An array of parameters passed to request URI
     * @return stdClass JSON-decoded response returned from API request
     */
    public function getLikes($id, $attrs = array()) {
        $url = $this->prefix() . '/' . urlencode($id) . '/likes';
        return $this->makeRequest($url, $attrs);
    }

}
