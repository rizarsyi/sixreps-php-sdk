<?php

/**
 * Sixreps_Api_Group
 */
class Sixreps_Api_Group extends Sixreps_Api_Base {

	public function prefix() {
		return 'groups';
	}

	public function getGroup($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id);
		return $this->makeRequest($url, $attrs);
	}

	public function getFeeds($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id) . '/feed';
		return $this->makeRequest($url, $attrs);
	}

	public function getMembers($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id) . '/members';
		return $this->makeRequest($url, $attrs);
	}

}
