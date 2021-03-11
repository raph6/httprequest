<?php
/**
 * @author Raphaël BLEUZET <https://github.com/raph6>
 */
namespace raph6\HttpRequest;
/**
 * Simple HttpRequest
 * Using curl
 *
 * @version 1.1.5
 */
class HttpRequest
{
    private $_ch;
    private $_timeout = 10;
    private $_url;
    private $_data;

    public function __construct ($url = null) {
        $this->_ch = curl_init();
        if ($url !== null) {
            $this->_url = $url;
        }
        curl_setopt($this->_ch, CURLOPT_TIMEOUT, $this->_timeout);
        curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, true);
    }

    public function setBasicAuth($username, $password) {
        curl_setopt($this->_ch, CURLOPT_USERPWD, $username . ":" . $password);
        return $this;
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

    public function setCookies($cookies = array()) {
        $reformated = [];

        foreach ($cookies as $key => $value) {
            $reformated[] = $key . '=' . $value;
        }

        curl_setopt($this->_ch, CURLOPT_COOKIE, implode(';', $reformated));

        return $this;
    }

    public function setUrl($url)
    {
        $this->_url = $url;
        return $this;
    }

    public function setData($data)
    {
        $this->_data = $data;
        return $this;
    }

    public function setUserAgent($user_agent) {
        curl_setopt($this->_ch, CURLOPT_USERAGENT, $user_agent);
        return $this;
    }

    public function post()
    {
        if (!empty($this->_data)) {
            curl_setopt($this->_ch, CURLOPT_POSTFIELDS, http_build_query($this->_data, '', '&'));
        }
        curl_setopt($this->_ch, CURLOPT_POST, true);
        return $this->_request();
    }

    public function get()
    {
        if (!empty($this->_data)) {
            $this->_url .= (stripos($this->_url, '?') !== false) ? '&' : '?';
            $this->_url .= http_build_query($this->_data, '', '&');
        }
        curl_setopt($this->_ch, CURLOPT_HTTPGET, true);
        return $this->_request();
    }

    private function _request() {
        curl_setopt($this->_ch, CURLOPT_URL, $this->_url);
        $output = curl_exec($this->_ch);
        curl_close($this->_ch); 
        return $output;
    }
}