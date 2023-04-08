<?php
declare( strict_types = 1 );

test( 'get', function() {
	$http = new HTTP();

	$response = $http->get( url: 'https://httpbin.org/broken/path' );
	error_log( var_export( $response, true ) );
	expect( $response['error'] )->toBe( true );
} );
