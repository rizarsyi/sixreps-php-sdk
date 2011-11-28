<?php

/**
 * Sixreps_Api_Video
 */
class Sixreps_Api_Video extends Sixreps_Api_Base {

	public function prefix() {
		return 'events';
	}

	public function getVideo($blogId, $attrs = array()) {
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
