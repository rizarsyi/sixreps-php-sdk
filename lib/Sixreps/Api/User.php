<?php
/**
 * Sixreps - Official Sixreps PHP SDK
 *
 * @author Sixreps
 */

/**
 * Sixreps_Api_User
 *
 * Maps request to users API resource served by main Sixreps API server
 *
 * @package Sixreps
 * @subpackage Sixreps.Api
 */
class Sixreps_Api_User extends Sixreps_Api_Base {

    /**
     * API resource prefix
     *
     * @return string Prefix name of users API resource
     */
    public function prefix() {
        return 'users';
    }

    /**
     * Get specific user.
     *
     * @param int $id User ID
     * @param array $attrs An array of parameters passed to request URI
     * @return stdClass JSON-decoded response returned from API request
     */
    public function getUser($id, $attrs = array()) {
        $url = $this->prefix() . '/' . urlencode($id);
        return $this->makeRequest($url, $attrs);
    }

    /**
     * Get all feeds belong to specific user.
     *
     * @param int $id User ID
     * @param array $attrs An array of parameters passed to request URI
     * @return stdClass JSON-decoded response returned from API request
     */
    public function getFeeds($id, $attrs = array()) {
        $url = $this->prefix() . '/' . urlencode($id) . '/feed';
        return $this->makeRequest($url, $attrs);
    }

    /**
     * Get all feeds belong to specific user and friends.
     *
     * @param int $id User ID
     * @param array $attrs An array of parameters passed to request URI
     * @return stdClass JSON-decoded response returned from API request
     */
    public function getHome($id, $attrs = array()) {
        $url = $this->prefix() . '/' . urlencode($id) . '/home';
        return $this->makeRequest($url, $attrs);
    }

    /**
     * Get all friends of specific user.
     *
     * @param int $id User ID
     * @param array $attrs An array of parameters passed to request URI
     * @return stdClass JSON-decoded response returned from API request
     */
    public function getFriends($id, $attrs = array()) {
        $url = $this->prefix() . '/' . urlencode($id) . '/friends';
        return $this->makeRequest($url, $attrs);
    }

    /**
     * Get all incoming messages belong to specific user.
     *
     * @param int $id User ID
     * @param array $attrs An array of parameters passed to request URI
     * @return stdClass JSON-decoded response returned from API request
     */
    public function getInbox($id, $attrs = array()) {
        $url = $this->prefix() . '/' . urlencode($id) . '/inbox';
        return $this->makeRequest($url, $attrs);
    }

    /**
     * Get all groups joined by specific user.
     *
     * @param int $id User ID
     * @param array $attrs An array of parameters passed to request URI
     * @return stdClass JSON-decoded response returned from API request
     */
    public function getGroups($id, $attrs = array()) {
        $url = $this->prefix() . '/' . urlencode($id) . '/groups';
        return $this->makeRequest($url, $attrs);
    }

    /**
     * Get all events participated by specific user.
     *
     * @param int $id User ID
     * @param array $attrs An array of parameters passed to request URI
     * @return stdClass JSON-decoded response returned from API request
     */
    public function getEvents($id, $attrs = array()) {
        $url = $this->prefix() . '/' . urlencode($id) . '/events';
        return $this->makeRequest($url, $attrs);
    }

    /**
     * Get all blogs created by specific user.
     *
     * @param int $id User ID
     * @param array $attrs An array of parameters passed to request URI
     * @return stdClass JSON-decoded response returned from API request
     */
    public function getBlogs($id, $attrs = array()) {
        $url = $this->prefix() . '/' . urlencode($id) . '/blogs';
        return $this->makeRequest($url, $attrs);
    }

    /**
     * Get all albums created by specific user.
     *
     * @param int $id User ID
     * @param array $attrs An array of parameters passed to request URI
     * @return stdClass JSON-decoded response returned from API request
     */
    public function getAlbums($id, $attrs = array()) {
        $url = $this->prefix() . '/' . urlencode($id) . '/albums';
        return $this->makeRequest($url, $attrs);
    }

    /**
     * Get all photos uploaded by specific user.
     *
     * @param int $id User ID
     * @param array $attrs An array of parameters passed to request URI
     * @return stdClass JSON-decoded response returned from API request
     */
    public function getPhotos($id, $attrs = array()) {
        $url = $this->prefix() . '/' . urlencode($id) . '/photos';
        return $this->makeRequest($url, $attrs);
    }

    /**
     * Get all videos uploaded by specific user.
     *
     * @param int $id User ID
     * @param array $attrs An array of parameters passed to request URI
     * @return stdClass JSON-decoded response returned from API request
     */
    public function getVideos($id, $attrs = array()) {
        $url = $this->prefix() . '/' . urlencode($id) . '/videos';
        return $this->makeRequest($url, $attrs);
    }

}
