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
 * GET, POST, PUT, and DELETE requests.
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
     * @var bool Verify SSL using bundle certificate from SDK
     */
    protected $_verify_bundle = false;
    protected $_cacert_path;

    /**
     * @var array A list of supported HTTP methods
     */
    protected $_http_methods = array('GET', 'POST', 'PUT', 'DELETE');

    /**
     * Create a new instance of Sixreps.
     * @return  void
     */
    public function __construct($host = null, $verify_bundle = false) {
        if (!empty($host)) {
            $this->_host = $host;
        }

        $this->_verify_bundle = $verify_bundle;
        $this->_cacert_path = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cacert.pem';
    }

    /**
     * Tell CURL to verify cert using bundle certificate or not.
     *
     * @param   bool  $verify_bundle
     */
    public function verifyLocalCert($verify_bundle = false) {
        return $this->_verify_bundle = $verify_bundle;
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

        $curl_options = array(
            CURLOPT_USERAGENT      => 'sixreps-php-0.1',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT        => 60,
        );

        switch ($method) {
            case 'GET':
                if (!empty($args)) {
                    $url = $url . '?' . http_build_query($args);
                }
                break;
            case 'POST':
                $curl_options[CURLOPT_POST] = true;
                if (!empty($args)) {
                    $curl_options[CURLOPT_POSTFIELDS] = $args;
                }
                break;
            case 'PUT':
                $curl_options[CURLOPT_CUSTOMREQUEST] = 'PUT';
                if (!empty($args)) {
                    $curl_options[CURLOPT_POSTFIELDS] = $args;
                }
                break;
            case 'DELETE':
                $curl_options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
                if (!empty($args)) {
                    $url = $url . '?' . http_build_query($args);
                }
                break;
            default:
                throw new InvalidArgumentException(sprintf(
                    'Unsupported %s HTTP method. It should match one of %s keywords.',
                    $method, implode(', ', $this->_http_methods)
                ));
        }

        if (!empty($headers)) {
            $curl_options[CURLOPT_HTTPHEADER] = $headers;
        }

        if ($this->_verify_bundle == true) {
            $curl_options[CURLOPT_CAINFO] = $this->_cacert_path;
        }

        $request = curl_init($url);
        curl_setopt_array($request, $curl_options);

        $body = curl_exec($request);
        $info = curl_getinfo($request);

        if (curl_errno($request) == 60) { // CURLE_SSL_CACERT
            curl_setopt($request, CURLOPT_CAINFO, $this->_cacert_path);
            $body = curl_exec($request);
            $info = curl_getinfo($request);
        }

        curl_close($request);
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
            array(
                'content_type' => $info['content_type'],
                'http_code'    => $info['http_code'],
                'url'          => $info['url'],
                'method'       => $method
            )
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
