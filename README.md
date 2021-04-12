# HttpRequest
composer package for http request using curl

### Installation
```shell
composer require raph6/httprequest
```

### Example of use
```php
use raph6\HttpRequest\HttpRequest;

# url
$http = new HttpRequest('https://httpbin.org/anything');
# or 
$http = new HttpRequest;
$http->setUrl('https://httpbin.org/anything')

# cookies
     ->setCookies(['bar' => 'foo'])

# data (get or post)
     ->setData(['foo' => 'bar'])

# headers
     ->setHeaders(['token' => '123456'])

# user agent
     ->setUserAgent('PHP/Curl (https://github.com/raph6/httprequest)')

# basic auth
     ->setBasicAuth('username', 'password')

# timeout (default 10)
     ->setTimeout(5);

var_dump($http->post());
// var_dump($http->get());
```
