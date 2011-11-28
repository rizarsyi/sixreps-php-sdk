<?php

/**
 * Sixreps_Api_Blog
 */
class Sixreps_Api_Blog extends Sixreps_Api_Base {

	public function prefix() {
		return 'blogs';
	}

	public function getBlog($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id);
		return $this->makeRequest($url, $attrs);
	}

	public function getComments($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id) . '/comments';
		return $this->makeRequest($url, $attrs);
	}

	public function getLikes($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id) . '/likes';
		return $this->makeRequest($url, $attrs);
	}

}
