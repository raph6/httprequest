# HttpRequest
composer package for http request using curl

### Installation
```shell
composer require raph6/httprequest
```

### Example of use
```php
use raph6\HttpRequest\HttpRequest;

$http = new HttpRequest('https://httpbin.org');
# or 
$http = new HttpRequest;
$http->setUrl('https://httpbin.org')
     ->setCookies(['bar' => 'foo'])
     ->setData(['foo' => 'bar'])
     ->setHeaders(['token' => '123456'])
     ->setUserAgent('PHP/Curl (https://github.com/raph6/httprequest)')
     ->setBasicAuth('username', 'password');

var_dump($http->post());
// var_dump($http->get());
```
