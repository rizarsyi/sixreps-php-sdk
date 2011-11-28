<?php
/**
 * Sixreps - Official Sixreps PHP SDK
 *
 * @author Sixreps
 */

/**
 * Sixreps_Api_Album
 *
 * Maps request to albums API resource served by main Sixreps API server
 *
 * @package Sixreps
 * @subpackage Sixreps.Api
 */
class Sixreps_Api_Album extends Sixreps_Api_Base {

	/**
	 * API resource prefix
	 *
	 * @return string Prefix name of albums API resource
	 */
	public function prefix() {
		return 'albums';
	}

	/**
	 * Get specific album.
	 *
	 * @param int $id Album ID
	 * @param array $attrs An array of parameters passed to request URI
	 * @return stdClass JSON-decoded response returned from API request
	 */
	public function getAlbum($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id);
		return $this->makeRequest($url, $attrs);
	}

	/**
	 * Get all comments for specific album.
	 *
	 * @param int $id Album ID
	 * @param array $attrs An array of parameters passed to request URI
	 * @return stdClass JSON-decoded response returned from API request
	 */
	public function getComments($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id) . '/comments';
		return $this->makeRequest($url, $attrs);
	}

	/**
	 * Get all likes for specific album.
	 *
	 * @param int $id Album ID
	 * @param array $attrs An array of parameters passed to request URI
	 * @return stdClass JSON-decoded response returned from API request
	 */
	public function getLikes($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id) . '/likes';
		return $this->makeRequest($url, $attrs);
	}

}
