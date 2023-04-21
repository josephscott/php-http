# php-http

<a href="https://github.com/josephscott/php-http/actions"><img src="https://github.com/josephscott/php-http/actions/workflows/tests.yml/badge.svg"></a>

For those times when you need a simple set of HTTP request functions, with no extras needed.  It is build upon `file_get_contents()`, keeping the easy URL requests easy.

## Install

`composer require josephscott/php-http`

Alternatively you can grab a copy of `https://raw.githubusercontent.com/josephscott/php-http/trunk/src/http.php` and `require` it as needed.

## Testing
`make test`

## Usage

```php
require __DIR__ . '/vendoer/autoload.php';

// Object style GET
$http = new HTTP();
$response = $http->get( url: 'https://httpbin.org/get' );
if ( $response['error'] ) {
	// Handle request error
}

// Object style POST
$response = $http->post(
	url: 'https://httpbin.org/post',
	headers: [ 'x-custom' => 'thing' ],
	data: [ 'hello' => 'world' ],
);

// Static style GET
$response = HTTP::get( url: 'https://httpbin.org/get' );

// Static style Post
$response = HTTP::post( url: 'https://httpbin.org/post' );
```

### The response array

The response is always an array, with the following fields:

- `error`: boolean
- `headers`: array of name/value pairs for the response headers
- `body`: string of the response body
- `total_time`: milliseconds it took for the entire request to complete
