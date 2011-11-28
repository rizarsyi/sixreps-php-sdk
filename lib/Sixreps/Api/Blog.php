<?php

/**
 * Sixreps_Api_Blog
 */
class Sixreps_Api_Blog extends Sixreps_Api_Base {

	public function prefix() {
		return 'blogs';
	}

	public function getBlog($blogId, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($blogId);
		return $this->makeRequest($url, $attrs);
	}

	public function getComments($blogId, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($blogId) . '/comments';
		return $this->makeRequest($url, $attrs);
	}

	public function getLikes($blogId, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($blogId) . '/likes';
		return $this->makeRequest($url, $attrs);
	}

}
