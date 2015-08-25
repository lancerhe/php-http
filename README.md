PHP Http
============

Http request and parse decorator (Easy to expand).

Requirements
------------

**PHP5.4.0 or later**

Installation
------------

Create or modify your composer.json

``` json
{
    "require": {
        "lancerhe/php-http": "dev-master"
    }
}
```

And run

``` sh
$ php composer.phar install
```

Usage
-----

### Build http request

``` php
<?php

require('./vendor/autoload.php');

$HttpRequest = new \Http\Request\Curl();
$HttpRequest->sendRequest("https://www.processon.com/notification/count", array('id' => 12));
var_dump( $HttpRequest->parseResponse() ); 
```

Result:

```
string(24) "{"count":0,"goon":false}"
```

Use simple crypt decorator:

``` php
<?php
require('./vendor/autoload.php');

$HttpRequest = new \Http\Request\Curl();
$HttpRequest = new \Http\Request\Decorator\SimpleCrypt($HttpRequest);
$HttpRequest->sendRequest("https://www.processon.com/notification/count", array('id' => 12));
var_dump( $HttpRequest->parseResponse() ); 
```

Result:

```
array(2) {
  'count' =>
  int(0)
  'goon' =>
  bool(false)
}
```

Use logger decorator:

``` php
<?php

include 'php-http/vendor/autoload.php';

$HttpRequest = new \Http\Request\Curl();
$HttpRequest = new \Http\Request\Decorator\SimpleCrypt($HttpRequest);
$HttpRequest = new \Http\Request\Decorator\LoggerFile($HttpRequest);
$HttpRequest->sendRequest("https://www.processon.com/notification/count", array('id' => 12));
var_dump( $HttpRequest->parseResponse() );
```

See log on /tmp/httprequest.log

```
tail -f /tmp/httprequest.log
============= [2015-08-25 05:49:10] >>>>>>>>>>>>
[request_header]     => POST /notification/count HTTP/1.1
Host: www.processon.com
Accept: */*
Content-Length: 43
Content-Type: application/x-www-form-urlencoded
[request_url]        => https://www.processon.com/notification/count
[request_body]       => id=12&sign=59ac2f3791de95684e7b7592266480dc
[response_http_code] => 200
[response_body]      => {"count":0,"goon":false}
```

Testing
-------

Just run `phpunit` (PHPUnit is required)