<?php

/**
 * Sixreps_Api_Event
 */
class Sixreps_Api_Event extends Sixreps_Api_Base {

	public function prefix() {
		return 'events';
	}

	public function getEvent($id, $attrs = array()) {
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
