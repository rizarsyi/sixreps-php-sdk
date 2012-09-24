<?php
/**
 * Sixreps - Official SixReps PHP SDK
 *
 * @author Sixreps
 */

/**
 * Sixreps
 *
 * This class acts as a client for SixReps API that provides a DSL to make
 * GET, POST, PUT, and DELETE requests. All request using Requests library
 * from https://github.com/rmccue/Requests
 *
 * Example:
 *
 *     $sixreps = new Sixreps();
 *
 *     // Use access token as an $args argument
 *     $sixreps->get('/users', array(
 *         'access_token' => 'YOUR_ACCESS_TOKEN',
 *     ));
 *
 *     // Use access token as an $headers argument
 *     $sixreps->get('/users', array(), array(
 *         'Authorization: token YOUR_ACCESS_TOKEN'
 *     ));
 *
 * @package Sixreps
 */
class Sixreps {

    /**
     * @var string Path to API resource server
     */
    protected $_host = 'https://api.sixreps.com/';

    /**
     * @var array A list of supported HTTP methods
     */
    protected $_http_methods = array('GET', 'POST', 'PUT', 'DELETE');

    /**
     * Create a new instance of Sixreps.
     * @return  void
     */
    public function __construct($host = null) {
        if (!empty($host)) {
            $this->_host = $host;
        }

        include(dirname(__FILE__) . '/lib/Requests.php');

        Requests::register_autoloader();
    }

    /**
     * DSL wrapper to make a GET request.
     *
     * @param   string  $uri        Path to API resource
     * @param   array   $args       Associative array of passed arguments
     * @param   array   $headers    List of passed headers
     * @return  array               Processed response
     * @see     Sixreps::_response
     * @see     Sixreps::_request
     */
    public function get($uri, $args = array(), $headers = array()) {
        return $this->_request($uri, $args, $headers, 'GET');
    }

    /**
     * DSL wrapper to make a POST request.
     *
     * @param   string  $uri        Path to API resource
     * @param   array   $args       Associative array of passed arguments
     * @param   array   $headers    List of passed headers
     * @return  array               Processed response
     * @see     Sixreps::_response
     * @see     Sixreps::_request
     */
    public function post($uri, $args = array(), $headers = array()) {
        return $this->_request($uri, $args, $headers, 'POST');
    }

    /**
     * DSL wrapper to make a PUT request.
     *
     * @param   string  $uri        Path to API resource
     * @param   array   $args       Associative array of passed arguments
     * @param   array   $headers    List of passed headers
     * @return  array               Processed response
     * @see     Sixreps::_response
     * @see     Sixreps::_request
     */
    public function put($uri, $args = array(), $headers = array()) {
        return $this->_request($uri, $args, $headers, 'PUT');
    }

    /**
     * DSL wrapper to make a DELETE request.
     *
     * @param   string  $uri        Path to API resource
     * @param   array   $args       Associative array of passed arguments
     * @param   array   $headers    List of passed headers
     * @return  array               Processed response
     * @see     Sixreps::_response
     * @see     Sixreps::_request
     */
    public function delete($uri, $args = array(), $headers = array()) {
        return $this->_request($uri, $args, $headers, 'DELETE');
    }

    /**
     * DSL wrapper to make a HTTP request based on supported HTTP methods.
     *
     * @param   string  $uri        Path to API resource
     * @param   array   $args       Associative array of passed arguments
     * @param   array   $headers    List of passed headers
     * @param   string  $method     HTTP method
     * @return  array               Processed response
     * @see     Sixreps::_response
     */
    protected function _request($uri, $args = array(), $headers = array(), $method = 'GET') {
        $url = $this->_host . trim($uri, '/');

        switch ($method) {
            case 'GET':
                if (!empty($args)) {
                    $url = $url . '?' . http_build_query($args);
                }
                $request = Requests::get($url, array());
                break;
            case 'POST':
                $request = Requests::post($url, array(), $args);
                break;
            case 'PUT':
                $request = Requests::put($url, array(), $args);
                break;
            case 'DELETE':
                if (!empty($args)) {
                    $url = $url . '?' . http_build_query($args);
                }
                $request = Requests::delete($url, array());
                break;
            default:
                throw new InvalidArgumentException(sprintf(
                    'Unsupported %s HTTP method. It should match one of %s keywords.',
                    $method, implode(', ', $this->_http_methods)
                ));
        }

        $body = $request->body;
        $info['headers'] = $request->headers;
        $info['headers'] = $request->headers;
        $info['status_code'] = $request->status_code;
        $info['success'] = $request->success;        
        $info['redirects'] = $request->redirects;        
        $info['url'] = $request->url;        

        return $this->_response($body, $info, $method);
    }

    /**
     * Typically process response returned from API request.
     *
     * @param   string  $body   Body of response returned from API request
     * @param   array   $info   Headers of response returned from API request
     * @return  array           Processed response
     */
    protected function _response($body, $info, $method) {
        return array(
            json_decode($body),
            $info
        );
    }

    /**
     * Handle uncaught exception.
     *
     * @param   Exception   $e  Exception or its subclasses
     * @return  void
     */
    public static function handle_exception(Exception $e) {
        die($e);
    }
}

// Throws exception if CURL extension is not loaded.
if (!function_exists('curl_init')) {
    throw new RuntimeException('Sixreps needs the CURL PHP extension.');
}

// Throws exception if JSON extension is not loaded.
if (!function_exists('json_decode')) {
    throw new RuntimeException('Sixreps needs the JSON PHP extension.');
}

// This determines which errors are reported by PHP.
// By default, all errors (including E_STRICT) are reported.
error_reporting(E_ALL | E_STRICT);

// PHP 5.3 will complain if you don't set a timezone. This tells PHP to use UTC.
if (@date_default_timezone_set(date_default_timezone_get()) === false) {
    date_default_timezone_set('UTC');
}

// Handle uncaught exception.
set_exception_handler(array('Sixreps', 'handle_exception'));