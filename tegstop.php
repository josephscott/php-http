<?php
function http_parse_headers( $headers ) {
	$parsed = [];

	foreach ( $headers as $header ) {
		$parts = explode( ':', $header, 2 );
		if ( count( $parts ) === 2 ) {
			$parsed[ strtolower( trim( $parts[0] ) ) ] = trim( $parts[1] );
		}
	}

    return $parsed;
}

function http_get( $url ) {
	$response = [];
	$body = file_get_contents( $url );

	$response['error'] = false;
	$response['headers'] = http_parse_headers( $http_response_header );
	$response['body'] = $body;

	if ( $body === false ) {
		$response['error'] = true;
		return $response;
	}

	return $response;
}

function http_post( $url, $data ) {
	$response = [];

	$options = [
		'http' => [
			'method' => 'POST',
			'header' => 'Content-Type: application/x-www-form-urlencoded',
			'content' => http_build_query( $data ),
		],
	];

    $context = stream_context_create( $options );
	$body = file_get_contents( $url, false, $context );

	$response['error'] = false;
	$response['headers'] = http_parse_headers( $http_response_header );
	$response['body'] = $body;

	if ( $body === false ) {
		$response['error'] = true;
		return $response;
	}

	return $response;
}
