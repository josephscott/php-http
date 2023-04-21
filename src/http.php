<?php
declare( strict_types = 1 );

class HTTP {
	// https://www.php.net/manual/en/context.http.php
	public $default_options = [
		'protocol_version' => 1.1,
		'method' => 'GET',
		'header' => '',
		'ignore_errors' => true,
		'timeout' => 90,
	];

	public $default_headers = [
		'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 php-http/0.1.1',
		'accept' => '*/*',
		'connection' => 'close'
	];

	public function __construct() { }

	public function __call(
		string $name,
		array $args
	):array {
		$response = $this->make_request(
			name: $name,
			args: $args
		);
		return $response;
	}

	public static function __callStatic( string $name, array $args ) {
		$http = new HTTP();
		$response = $http->make_request(
			name: $name,
			args: $args
		);
		return $response;
	}

	public function make_request( string $name, array $args ) {
		$url = $args['url'] ?? $args[0];
		$headers = $args['headers'] ?? $args[1] ?? [];
		$data = $args['data'] ?? $args[2] ?? [];

		$response = $this->request(
			method: strtoupper( $name ),
			url: $url,
			headers: $headers,
			data: $data
		);

		return $response;
	}

	public function request(
		string $method,
		string $url,
		array $headers = [],
		array $data = []
	):array {
		$response = [
			'error' => false,
			'headers' => [],
			'body' => '',
		];

		// https://developer.mozilla.org/en-US/docs/Web/HTTP/Methods
		$valid_methods = [
			'GET',
			'HEAD',
			'POST',
			'PUT',
			'DELETE',
			'CONNECT',
			'OPTIONS',
			'TRACE',
			'PATCH'
		];
		if ( !in_array( $method, $valid_methods, true ) ) {
			return $response;
		}

		$context = $this->build_context( method: $method, body: $data );

		// XXX: HACK
		// Make Pest happy by suppressing the warnings that can happen
		// I'd like to find a way to deal with warnings without using @
		$start = microtime( true );
		$body = @file_get_contents(
			filename: $url,
			use_include_path: false,
			context: $context
		);
		$response['total_time'] = number_format(
			( microtime( true ) - $start ),
			6
		);
		if ( $body === false ) {
			$response['error'] = true;
			return $response;
		}

		$response['headers'] = self::parse_headers( $http_response_header );
		$response['body'] = $body;

		if (
			$response['headers']['response_code'] < 200
			|| $response['headers']['response_code'] > 299
		) {
			$response['error'] = true;
			return $response;
		}

		return $response;
	}

	/* Private */

	private function build_context(
		string $method,
		array $headers = [],
		array $body = []
	) {
		$options = [ 'http' => $this->default_options ];
		$options['http']['method'] = $method;

		$headers = array_merge( $this->default_headers, $headers );

		if ( !empty( $body ) ) {
			$options['http']['content'] = http_build_query( $body );
			$headers['Content-Type'] = 'application/x-www-form-urlencoded';
		}

		foreach ( $headers as $header_name => $header_value ) {
			$options['http']['header'] .= "$header_name: $header_value\r\n";
		}

		$context = stream_context_create( $options );
		return $context;
	}

	private function parse_headers( array $headers ):array {
		$parsed = [];

		$response_code = array_shift( $headers );
		if ( preg_match( '#HTTP/[0-9\.]+\s+([0-9]+)#', $response_code, $matches ) ) {
			$headers[] = 'response_code: ' . intval( $matches[1] );
		}

		foreach ( $headers as $header ) {
			$parts = explode( ':', $header, 2 );
			if ( count( $parts ) === 2 ) {
				$parts[1] = trim( $parts[1] );
				if ( is_numeric( $parts[1] ) ) {
					$parts[1] = (int) $parts[1];
				}

				$parsed[ strtolower( trim( $parts[0] ) ) ] = $parts[1];
			}
		}

		return $parsed;
	}
}
