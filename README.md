# HttpRequest
## Example of use
```php
$http = new HttpRequest();
$http->setUrl('http://localhost:8080')
    ->setData(['foo' => 'bar'])
    ->setHeaders(['token' => '123456']);

var_dump($http->post());
//var_dump($http->get());
```