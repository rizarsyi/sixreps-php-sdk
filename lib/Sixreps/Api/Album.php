<?php

/**
 * Sixreps_Api_Album
 */
class Sixreps_Api_Album extends Sixreps_Api_Base {

	public function prefix() {
		return 'albums';
	}

	public function getAlbum($id, $attrs = array()) {
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
