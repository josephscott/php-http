<?php
declare( strict_types = 1 );

test( 'delete', function() {
	$http = new HTTP();
	$response = $http->delete( url: 'http://127.0.0.1:7878/?method=delete' );

	expect( $response['error'] )->toBe( false );
	expect( $response['headers']['response_code'] )->toBe( 200 );
	expect( $response['headers']['content-type'] )->toBe( 'application/json' );
} );

test( 'delete: static', function() {
	$response = HTTP::delete( url: 'http://127.0.0.1:7878/?method=delete' );

	expect( $response['error'] )->toBe( false );
	expect( $response['headers']['response_code'] )->toBe( 200 );
	expect( $response['headers']['content-type'] )->toBe( 'application/json' );
} );
