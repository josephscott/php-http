<?php
declare( strict_types = 1 );

test( 'get', function() {
	$http = new HTTP();
	$response = $http->get( url: 'http://httpbin.org/get' );

	expect( $response['error'] )->toBe( false );
	expect( $response['headers']['response_code'] )->toBe( 200 );
	expect( $response['headers']['content-type'] )->toBe( 'application/json' );
} );

test( 'get: fail, 500', function() {
	$http = new HTTP();
	$response = $http->get( url: 'http://httpbin.org/status/500' );

	expect( $response['error'] )->toBe( true );
	expect( $response['headers']['response_code'] )->toBe( 500 );
} );

test( 'get: timeout', function() {
	$http = new HTTP();
	$http->default_options['timeout'] = 3;
	$response = $http->get( url: 'httpstat.us/200?sleep=3000' );

	expect( $response['error'] )->toBe( true );
} );
