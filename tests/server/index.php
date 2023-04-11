<?php
$method = $_GET['method'] ?? null;
$method = strtolower( $method );
if ( strtolower( $_SERVER['REQUEST_METHOD'] ) !== $method ) {
	header( 'HTTP/1.0 405 Method Not Allowed' );
	exit;
}

$sleep = $_GET['sleep'] ?? 0;
sleep( $sleep );

$out = [];
foreach ( apache_request_headers() as $k => $v ) {
	$out['headers'][$k] = $v;
}

foreach ( $_GET as $k => $v ) {
	$out['get'][$k] = $v;
}

foreach ( $_POST as $k => $v ) {
	$out['post'][$k] = $v;
}

$json = json_encode( $out, JSON_PRETTY_PRINT );
header( 'Content-Type: application/json' );
echo $json;