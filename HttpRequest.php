<?php
/**
 * @author Raphael BLEUZET <rbleuzet@gmail.com>
 */

/**
 * Simple HttpRequest
 * Using curl
 *
 * @version 0.1
 */
class HttpRequest
{
    private $_url = "http://devraph.net/api.php";
    private $_post = array();

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
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_post);
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
}

$o = new HttpRequest();
$o->setUrl('http://devraph.net/api.php?option=test');
$o->setPost(array('login' => 'raph', 'password' => 'demo'));
$o->post();