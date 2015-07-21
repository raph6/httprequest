# HttpRequest
## Setting URL
Method : setUrl($url)

string : The URL to fetch.

## Setting POST
Method : setPost($array)

array : The full data to post in a HTTP "POST" operation.

## Setting Timeout
Method : setTimeout($integer)

Default is 10 seconds

int : Timeout in second

## Post
Method : post()

Returns TRUE on success or FALSE on failure.

## Get
Method : get()

Returns TRUE on success or FALSE on failure.

## Example of use
$o = new HttpRequest;
$o->setUrl('http://devraph.net/api.php?option=test'); // SETTING URL
$o->setPost(array('login' => 'raph', 'password' => 'demo')); // SETTING REQUEST
$o->setTimeout(15); // SETTING TIMEOUT
$o->post(); // POST