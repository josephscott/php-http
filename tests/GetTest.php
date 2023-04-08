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
