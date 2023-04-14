<?php
declare( strict_types = 1 );

test( 'head', function() {
	$http = new HTTP();
	$response = $http->head( url: 'http://127.0.0.1:7878/?method=head' );

	expect( $response['error'] )->toBe( false );
	expect( $response['headers']['response_code'] )->toBe( 200 );
	expect( $response['headers']['content-type'] )->toBe( 'application/json' );
} );
