<?php
/**
 * Sixreps - Official Sixreps PHP SDK
 *
 * @author Sixreps
 */

/**
 * Sixreps_Api_Group
 *
 * Maps request to groups API resource served by main Sixreps API server
 *
 * @package Sixreps
 * @subpackage Sixreps.Api
 */
class Sixreps_Api_Group extends Sixreps_Api_Base {

	/**
	 * API resource prefix
	 *
	 * @return string Prefix name of groups API resource
	 */
	public function prefix() {
		return 'groups';
	}

	/**
	 * Get specific group.
	 *
	 * @param int $id Group ID
	 * @param array $attrs An array of parameters passed to request URI
	 * @return stdClass JSON-decoded response returned from API request
	 */
	public function getGroup($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id);
		return $this->makeRequest($url, $attrs);
	}

	/**
	 * Get all feeds belong to a specific group.
	 *
	 * @param int $id Group ID
	 * @param array $attrs An array of parameters passed to request URI
	 * @return stdClass JSON-decoded response returned from API request
	 */
	public function getFeeds($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id) . '/feed';
		return $this->makeRequest($url, $attrs);
	}

	/**
	 * Get all members joined in a specific group.
	 *
	 * @param int $id Group ID
	 * @param array $attrs An array of parameters passed to request URI
	 * @return stdClass JSON-decoded response returned from API request
	 */
	public function getMembers($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id) . '/members';
		return $this->makeRequest($url, $attrs);
	}

}
