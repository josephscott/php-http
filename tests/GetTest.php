<?php
declare( strict_types = 1 );

test( 'get', function() {
	$http = new HTTP();

	$response = $http->get( url: 'https://httpbin.org/get' );
	expect( $response['error'] )->toBe( false );
	expect( $response['headers']['response_code'] )->toBe( 200 );
	expect( $response['headers']['content-type'] )->toBe( 'application/json' );
} );
