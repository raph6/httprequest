<?php
/**
 * @author Raphael BLEUZET <rbleuzet@gmail.com>
 */
namespace HttpRequest;
/**
 * Simple HttpRequest
 * Using curl
 *
 * @version 0.1
 */
class HttpRequest
{
    private $_url = "";
    private $_post = array();
    private $_timeout = 10;
    private $_headers = array();

    /**
     * Check if curl is enabled or disabled
     */
    private function _enableCurl()
    {
        if (!function_exists('curl_version')) {
            echo 'Please enable php_curl';
            exit;
        }
    }

    public function setHeaders($headers = array())
    {
        $reformated = [];

        foreach ($headers as $key => $value) {
            $reformated[] = $key . ': ' . $value;
        }

        $this->_headers = $reformated;

        return true;
    }
    /**
     * Execute your request
     *
     * @return $output Returns TRUE on success or FALSE on failure.
     */
    public function post()
    {
        $this->_enableCurl();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_post);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->_timeout);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    /**
     * Getting
     *
     * @return $output Returns TRUE on success or FALSE on failure.
     */
    public function get()
    {
        $this->_enableCurl();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->_timeout);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    /**
     * Set url
     *
     * @param string $url The URL to fetch.
     */
    public function setUrl($url)
    {
        $this->_url = $url;
    }

    /**
     * Set an array with your post request
     *
     * @param array $post The full data to post in a HTTP "POST" operation.
     */
    public function setPost($post)
    {
        $this->_post = $post;
    }

    /**
     * Set timeout
     *
     * @param integet $timeout Timeout in second
     */
    public function setTimeout($timeout)
    {
        $this->_timeout = $timeout;
    }
}
