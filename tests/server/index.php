<?php
$sleep = $_GET['sleep'] ?? 0;
sleep( $sleep );

$out = [];
foreach ( apache_request_headers() as $k => $v ) {
	$out[$k] = $v;
}

foreach ( $_GET as $k => $v ) {
	$out['GET'][$k] = $v;
}

foreach ( $_POST as $k => $v ) {
	$out['POST'][$k] = $v;
}

$json = json_encode( $out, JSON_PRETTY_PRINT );
header( 'Content-Type: application/json' );
echo $json;
