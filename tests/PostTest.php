<?php
declare( strict_types = 1 );

test( 'post', function() {
	$http = new HTTP();

	$response = $http->post( url: 'https://httpbin.org/post' );
	expect( $response['error'] )->toBe( false );
	expect( $response['headers']['response_code'] )->toBe( 200 );
	expect( $response['headers']['content-type'] )->toBe( 'application/json' );
} );
