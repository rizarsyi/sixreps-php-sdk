<?php

/**
 * Sixreps_Api_Photo
 */
class Sixreps_Api_Photo extends Sixreps_Api_Base {

	public function prefix() {
		return 'events';
	}

	public function getPhoto($blogId, $attrs = array()) {
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
