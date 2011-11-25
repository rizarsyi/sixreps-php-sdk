<?php

class Sixreps_Api_Album extends Sixreps_Api_Base {

	public function prefix() {
		return 'albums';
	}

	public function getAlbum($albumId, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($albumId);
		return $this->makeRequest($url, $attrs);
	}

	public function getComments($albumId, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($albumId) . '/comments';
		return $this->makeRequest($url, $attrs);
	}

	public function getLikes($albumId, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($albumId) . '/likes';
		return $this->makeRequest($url, $attrs);
	}

}
