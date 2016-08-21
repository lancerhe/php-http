PHP Http
============

[![Latest Stable Version](https://poser.pugx.org/lancerhe/php-http/v/stable)](https://packagist.org/packages/lancerhe/php-http) [![Total Downloads](https://poser.pugx.org/lancerhe/php-http/downloads)](https://packagist.org/packages/lancerhe/php-http) [![Latest Unstable Version](https://poser.pugx.org/lancerhe/php-http/v/unstable)](https://packagist.org/packages/lancerhe/php-http) [![License](https://poser.pugx.org/lancerhe/php-http/license)](https://packagist.org/packages/lancerhe/php-http)

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
        "lancerhe/php-http": "1.1.0"
    }
}
```

And run

``` sh
$ php composer.phar install
```

Usage
-----

#### Http Request

Build a http request.

``` php
<?php
require('./vendor/autoload.php');

$HttpRequest = new \LancerHe\Http\Request\Curl();
$HttpRequest->sendRequest("https://www.processon.com/notification/count", array('id' => 12));
var_dump( $HttpRequest->parseResponse() ); 

// result
// string(24) "{"count":0,"goon":false}"
```

Build a http request with simple crypt decorator.

``` php
<?php
require('./vendor/autoload.php');

$HttpRequest = new \LancerHe\Http\Request\Curl();
$HttpRequest = new \LancerHe\Http\Request\Decorator\SimpleCrypt($HttpRequest);
$HttpRequest->sendRequest("https://www.processon.com/notification/count", array('id' => 12));
var_dump( $HttpRequest->parseResponse() ); 

// result
// array(2) {
//   'count' =>
//   int(0)
//   'goon' =>
//   bool(false)
// }
```

Build a http request with file logger decorator.

``` php
<?php

include 'php-http/vendor/autoload.php';

$HttpRequest = new \LancerHe\Http\Request\Curl();
$HttpRequest = new \LancerHe\Http\Request\Decorator\SimpleCrypt($HttpRequest);
$HttpRequest = new \LancerHe\Http\Request\Decorator\LoggerFile($HttpRequest);
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

#### Http Parse

Build a http parse.

``` php
<?php
require('./vendor/autoload.php');

$HttpParse = new \LancerHe\Http\Parse\Sample("header=user&name=lancer");
$HttpParse->parse();
var_dump( $HttpParse->parse() ); 
// result
// string(23) "header=user&name=lancer"
```

Build a http parse with simple crypt

``` php
$HttpParse = new \LancerHe\Http\Parse\Sample("user=Lancer&age=28&sign=0edd12427c5ccea50701bb95c8f2d8cf");
$HttpParse = new \LancerHe\Http\Parse\Decorator\SimpleCrypt($HttpParse);
$HttpParse->parse();
var_dump( $HttpParse->parse() );
// result
// array(2) {
//   'user' =>
//   string(6) "Lancer"
//   'age' =>
//   string(2) "28"
// } 
```

Build a http parse with file logger decorator.

``` php
$HttpParse = new \LancerHe\Http\Parse\Sample("user=Lancer&age=28&sign=0edd12427c5ccea50701bb95c8f2d8cf");
$HttpParse = new \LancerHe\Http\Parse\Decorator\SimpleCrypt($HttpParse);
$HttpParse = new \LancerHe\Http\Parse\Decorator\LoggerFile($HttpParse);
$HttpParse->parse();
var_dump( $HttpParse->parse() );
```

See log on /tmp/httpparse.log

``` php
array (
  'datetime' => '2015-08-25 18:05:38',
  'origin' => 'user=Lancer&age=28&sign=0edd12427c5ccea50701bb95c8f2d8cf',
  'decode' => 
  array (
    'user' => 'Lancer',
    'age' => '28',
  ),
)
```

Testing
-------

Just run `phpunit`
```
phpunit -c phpunit.xml
```