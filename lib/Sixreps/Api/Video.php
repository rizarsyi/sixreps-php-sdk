<?php

/**
 * Sixreps_Api_Video
 */
class Sixreps_Api_Video extends Sixreps_Api_Base {

	public function prefix() {
		return 'videos';
	}

	public function getVideo($id, $attrs = array()) {
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
