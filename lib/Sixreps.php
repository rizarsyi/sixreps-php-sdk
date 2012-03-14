<?php
/**
 * Sixreps - Official Sixreps PHP SDK
 *
 * @author Sixreps
 */

/**
 * Sixreps
 *
 * @package Sixreps
 */
class Sixreps {

    /**
     * @var string Path to API resource server
     */
    protected $_host = 'https://api.sixreps.com/';

    /**
     * @var string User Agent name
     */
    protected $_user_agent = 'sixreps-php-0.1';

    /**
     * @var array A list of supported HTTP methods
     */
    protected $_http_methods = array('GET', 'POST', 'PUT', 'DELETE');

    /**
     * Create a new instance of Sixreps.
     *
     * @param   string  $app_secret Application secret obtained when creating app
     * @return  void
     */
    public function __construct($app_secret, $host = null) {
        $this->app_secret = $app_secret;
        if (!empty($host)) {
            $this->_host = $host;
        }
    }

    /**
     * DSL wrapper to make a GET request.
     *
     * @param   string  $uri    Path to API resource
     * @param   array   $args   Associative array of passed arguments
     * @return  array           Associative array of processed response
     * @see     Sixreps::_response
     * @see     Sixreps::_request
     */
    public function get($uri, $args = array()) {
        return $this->_request($uri, $args, 'GET');
    }

    /**
     * DSL wrapper to make a POST request.
     *
     * @param   string  $uri    Path to API resource
     * @param   array   $args   Associative array of passed arguments
     * @return  array           Associative array of processed response
     * @see     Sixreps::_response
     * @see     Sixreps::_request
     */
    public function post($uri, $args = array()) {
        return $this->_request($uri, $args, 'POST');
    }

    /**
     * DSL wrapper to make a PUT request.
     *
     * @param   string  $uri    Path to API resource
     * @param   array   $args   Associative array of passed arguments
     * @return  array           Associative array of processed response
     * @see     Sixreps::_response
     * @see     Sixreps::_request
     */
    public function put($uri, $args = array()) {
        return $this->_request($uri, $args, 'PUT');
    }

    /**
     * DSL wrapper to make a DELETE request.
     *
     * @param   string  $uri    Path to API resource
     * @param   array   $args   Associative array of passed arguments
     * @return  array           Associative array of processed response
     * @see     Sixreps::_response
     * @see     Sixreps::_request
     */
    public function delete($uri, $args = array()) {
        return $this->_request($uri, $args, 'DELETE');
    }

    /**
     * DSL wrapper to make a HTTP request based on supported HTTP methods.
     *
     * @param   string  $uri    Path to API resource
     * @param   array   $args   Associative array of passed arguments
     * @param   string  $method HTTP method
     * @return  array           Associative array of processed response
     * @see     Sixreps::_response
     */
    protected function _request($uri, $args = array(), $method = 'GET') {
        $url = $this->_host . trim($uri, '/');

        $curl_options = array(
            CURLOPT_USERAGENT      => $this->_user_agent,
            CURLOPT_RETURNTRANSFER => true
        );

        if (!empty($args)) {
            switch ($method) {
                case 'GET':
                    $url = $url . '?' . http_build_query($args);
                    break;
                case 'POST':
                    $curl_options[CURLOPT_POST]       = true;
                    $curl_options[CURLOPT_POSTFIELDS] = $args;
                    break;
                case 'PUT':
                    $curl_options[CURLOPT_CUSTOMREQUEST] = 'PUT';
                    $curl_options[CURLOPT_POSTFIELDS]    = $args;
                    break;
                case 'DELETE':
                    $curl_options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
                    $url = $url . '?' . http_build_query($args);
                    break;
                default:
                    throw new InvalidArgumentException(sprintf(
                        'Unsupported %s HTTP method. It should match one of %s keywords.',
                        $method, implode(', ', $this->_http_methods)
                    ));
            }

        }

        $request = curl_init($url);
        curl_setopt_array($request, $curl_options);

        $body    = curl_exec($request);
        $headers = curl_getinfo($request);

        curl_close($request);
        return $this->_response($body, $headers);
    }

    /**
     * Typically process response returned from API request.
     *
     * @param   string  $body       Body of response returned from API request
     * @param   array   $headers    Headers of response returned from API request
     * @return  array               Associative array of processed response
     */
    protected function _response($body, $headers) {
        return array(
            'body'    => json_decode($body),
            'headers' => array(
                'content_type' => $headers['content_type'],
                'http_code'    => $headers['http_code']
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
