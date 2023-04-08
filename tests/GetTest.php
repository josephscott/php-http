<?php
declare( strict_types = 1 );

test( 'get', function() {
	$http = new HTTP();

	$response = $http->get( url: 'https://httpbin.org/broken/path' );
	expect( $response['error'] )->toBe( true );
} );
