<?php
/**
 * Sixreps - Official Sixreps PHP SDK
 *
 * @author Sixreps
 */

// Throws exception if CURL extension is not loaded
if (!function_exists('curl_init')) {
    throw new RuntimeException('Sixreps needs the CURL PHP extension.');
}

// Throws exception if JSON extension is not loaded
if (!function_exists('json_decode')) {
    throw new RuntimeException('Sixreps needs the JSON PHP extension.');
}

/**
 * Sixreps
 *
 * @package Sixreps
 */
class Sixreps {

    /**
     * Path to API resource server.
     *
     * @var array
     */
    protected $_host = 'https://api.sixreps.com/';

    /**
     * User Agent name.
     *
     * @var array
     */
    protected $_user_agent = 'sixreps-php-0.1';

    /**
     * A list of supported HTTP methods.
     *
     * @var array
     */
    protected $_http_methods = array('GET', 'POST', 'PUT', 'DELETE');

    /**
     * Create a new instance of Sixreps.
     *
     * @param string $app_secret Application secret obtained when creating app
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
     * @param string $uri Path to API resource
     * @param array $args Associative array of passed arguments
     * @return array Associative array of processed response
     * @see Sixreps::_response
     * @see Sixreps::_request
     */
    public function get($uri, $args = array()) {
        return $this->_request($uri, $args);
    }

    /**
     * DSL wrapper to make a POST request.
     *
     * @param string $uri Path to API resource
     * @param array $args Associative array of passed arguments
     * @return array Associative array of processed response
     * @see Sixreps::_response
     * @see Sixreps::_request
     */
    public function post($uri, $args = array()) {
        return $this->_request($uri, $args, 'POST');
    }

    /**
     * DSL wrapper to make a PUT request.
     *
     * @param string $uri Path to API resource
     * @param array $args Associative array of passed arguments
     * @return array Associative array of processed response
     * @see Sixreps::_response
     * @see Sixreps::_request
     */
    public function put($uri, $args = array()) {
        return $this->_request($uri, $args, 'PUT');
    }

    /**
     * DSL wrapper to make a DELETE request.
     *
     * @param string $uri Path to API resource
     * @param array $args Associative array of passed arguments
     * @return array Associative array of processed response
     * @see Sixreps::_response
     * @see Sixreps::_request
     */
    public function delete($uri, $args = array()) {
        return $this->_request($uri, $args, 'DELETE');
    }

    /**
     * DSL wrapper to make a HTTP request based on supported HTTP methods.
     *
     * @param string $uri Path to API resource
     * @param array $args Associative array of passed arguments
     * @param string $method HTTP method
     * @return array Associative array of processed response
     * @see Sixreps::_response
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
                    throw new InvalidArgumentException(sprintf('Unsupported %s HTTP method. It should match one of %s keywords.', $method, implode(', ', $this->_http_methods)));
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
     * @param string $body Body of response returned from API request
     * @param array $headers Headers of response returned from API request
     * @return array Associative array of processed response
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

}
