<?php

use raph6\HttpRequest\HttpRequest;

use PHPUnit\Framework\TestCase;

class HttpRequestTest extends TestCase {

    public function testCanSetCookie()
    {
        $data = ['foo' => 'bar', 'cookie' => 'hello'];

        $http = new HttpRequest('https://httpbin.org/cookies');
        $http->setCookies($data);
        
        $cookies = json_decode($http->get(), true);

        $this->assertEquals($cookies['cookies'], $data);
    }

    public function testPost()
    {
        $data = ['foo' => 'bar', 'post' => 'hello'];

        $http = new HttpRequest('https://httpbin.org/anything');
        $http->setData($data);
        
        $post = json_decode($http->post(), true);

        $this->assertEquals($post['method'], 'POST');
        $this->assertEquals($post['form'], $data);
    }

    public function testGet()
    {
        $data = ['foo' => 'bar', 'get' => 'hello'];

        $http = new HttpRequest('https://httpbin.org/anything');
        $http->setData($data);
        
        $get = json_decode($http->get(), true);

        $this->assertEquals($get['method'], 'GET');
        $this->assertEquals($get['args'], $data);
    }

    public function testUserAgent()
    {
        $userAgent = 'raph6/httprequest';

        $http = new HttpRequest('https://httpbin.org/anything');
        $http->setUserAgent('raph6/httprequest');
        
        $get = json_decode($http->get(), true);

        $this->assertEquals($get['headers']['User-Agent'], $userAgent);
    }

    public function testHeader()
    {
        $headers = ['Bar' => 'foo', 'Sess' => 1234];

        $http = new HttpRequest('https://httpbin.org/anything');
        $http->setHeaders($headers);
        
        $get = json_decode($http->get(), true);

        $this->assertEquals($get['headers']['Bar'], $headers['Bar']);
        $this->assertEquals($get['headers']['Sess'], $headers['Sess']);
    }
}