<?php
declare( strict_types = 1 );

test( 'get', function() {
	$http = new HTTP();
	$response = $http->get( url: 'http://127.0.0.1:7878/?method=get' );

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
	$response = $http->get( url: 'http://127.0.0.1:7878/?method=get&sleep=4' );

	expect( $response['error'] )->toBe( false );
	expect( $response['total_time'] )->toBeGreaterThan( 3 );
} );
