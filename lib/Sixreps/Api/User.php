<?php

/**
 * Sixreps_Api_User
 */
class Sixreps_Api_User extends Sixreps_Api_Base {

	public function prefix() {
		return 'users';
	}

	public function getUser($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id);
		return $this->makeRequest($url, $attrs);
	}

	public function getFeeds($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id) . '/feed';
		return $this->makeRequest($url, $attrs);
	}

	public function getHome($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id) . '/home';
		return $this->makeRequest($url, $attrs);
	}

	public function getFriends($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id) . '/friends';
		return $this->makeRequest($url, $attrs);
	}

	public function getInbox($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id) . '/inbox';
		return $this->makeRequest($url, $attrs);
	}

	public function getGroups($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id) . '/groups';
		return $this->makeRequest($url, $attrs);
	}

	public function getEvents($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id) . '/events';
		return $this->makeRequest($url, $attrs);
	}

	public function getBlogs($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id) . '/blogs';
		return $this->makeRequest($url, $attrs);
	}

	public function getAlbums($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id) . '/albums';
		return $this->makeRequest($url, $attrs);
	}

	public function getPhotos($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id) . '/photos';
		return $this->makeRequest($url, $attrs);
	}

	public function getVideos($id, $attrs = array()) {
		$url = $this->prefix() . '/' . urlencode($id) . '/videos';
		return $this->makeRequest($url, $attrs);
	}

}
