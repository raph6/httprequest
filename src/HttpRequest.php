<?php
/**
 * @author Raphaël BLEUZET <https://github.com/raph6>
 */
namespace raph6\HttpRequest;
/**
 * Simple HttpRequest
 * Using curl
 *
 * @version 0.9
 */
class HttpRequest
{
    private $_ch;
    private $_timeout = 10;

    public function __construct () {
        if (!function_exists('curl_version')) {
            echo 'Please enable php_curl';
            die();
        }

        $this->_ch = curl_init();
        curl_setopt($this->_ch, CURLOPT_TIMEOUT, $this->_timeout);
    }

    public function setHeaders($headers = array())
    {
        $reformated = [];

        foreach ($headers as $key => $value) {
            $reformated[] = $key . ': ' . $value;
        }

        curl_setopt($this->_ch, CURLOPT_HTTPHEADER, $reformated);

        return $this;
    }

    public function setUrl($url)
    {
        curl_setopt($this->_ch, CURLOPT_URL, $url);
        return $this;
    }

    public function setData($post)
    {
        curl_setopt($this->_ch, CURLOPT_POSTFIELDS, $post);
        return $this;
    }

    public function post()
    {
        curl_setopt($this->_ch, CURLOPT_POST, 1);
        curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($this->_ch);
        curl_close($this->_ch);
        return $output;
    }

    public function get()
    {
        curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($this->_ch);
        curl_close($this->_ch); 
        return $output;
    }
}


// $http = new HttpRequest();
// $http->setUrl('http://localhost:8080')
//     ->setData(['foo' => 'bar'])
//     ->setHeaders(['token' => '123456']);

// var_dump($http->post());
// //var_dump($http->get());