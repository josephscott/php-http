<?php
declare( strict_types = 1 );

test( 'get', function() {
	$http = new HTTP();
	$response = $http->get( url: 'http://127.0.0.1:7878/?method=get' );

	expect( $response['error'] )->toBe( false );
	expect( $response['headers']['response_code'] )->toBe( 200 );
	expect( $response['headers']['content-type'] )->toBe( 'application/json' );
} );

test( 'get: static', function() {
	$response = HTTP::get( url: 'http://127.0.0.1:7878/?method=get' );

	expect( $response['error'] )->toBe( false );
	expect( $response['headers']['response_code'] )->toBe( 200 );
	expect( $response['headers']['content-type'] )->toBe( 'application/json' );
} );

test( 'get: fail, 500', function() {
	$http = new HTTP();
	$response = $http->get( url: 'http://127.0.0.1:7878/?method=get&status=500' );

	expect( $response['error'] )->toBe( true );
	expect( $response['headers']['response_code'] )->toBe( 500 );
} );

test( 'get: timeout', function() {
	$http = new HTTP();
	$http->default_options['timeout'] = 3;
	$response = $http->get( url: 'http://127.0.0.1:7878/?method=get&sleep=10' );

	expect( $response['error'] )->toBe( true );
} );

test( 'get: slow', function() {
	$http = new HTTP();
	$response = $http->get( url: 'http://127.0.0.1:7878/?method=get&sleep=1' );

	expect( $response['error'] )->toBe( false );
	expect( $response['total_time'] )->toBeGreaterThan( 1 );
} );

test( 'get: custom user agent', function() {
	$custom_ua = 'pest test';

	$http = new HTTP();
	$http->default_headers['user_agent'] = $custom_ua;

	$response = $http->get( url: 'http://127.0.0.1:7878/?method=get' );
	$body = json_decode( $response['body'], true );

	expect( $response['error'] )->toBe( false );
	expect( $body['headers']['user_agent'] )->toBe( $custom_ua );
} );

test( 'get: port with no web server', function() {
	$http = new HTTP();
	$response = $http->get( url: 'http://127.0.0.1:3456/?method=get' );

	expect( $response['error'] )->toBe( true );
	expect( $response['headers'] )->toBe( [] );
	expect( $response['body'] )->toBe( '' );
} );
