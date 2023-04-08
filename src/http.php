<?php
declare( strict_types = 1 );

class HTTP {
	public $default_headers = [
		'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 php-http/0.0.2',
		'accept' => '*/*',
	];

	public function __construct() { }

	public function get( string $url, array $headers = [] ) {
		$response = [];
		$context = $this->build_context( 'GET' );

		$this->set_error_handler();
		$body = file_get_contents(
			filename: $url,
			use_include_path: false,
			context: $context
		);
		restore_error_handler();

		$response['error'] = false;
		$response['headers'] = self::parse_headers( $http_response_header );
		$response['body'] = $body;

		if ( $body === false ) {
			$response['error'] = true;
			return $response;
		}

		return $response;
	}

	public function post( string $url, array $headers = [], array $data = [] ) {
		$response = [];
		$context = $this->build_context( method: 'POST', body: $data );

		$this->set_error_handler();
		$body = file_get_contents( $url, false, $context );
		restore_error_handler();

		$response['error'] = false;
		$response['headers'] = self::parse_headers( $http_response_header );
		$response['body'] = $body;

		if ( $body === false ) {
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
		$options = [
			'http' => [
				'method' => $method,
				'header' => '',
			]
		];

		$headers = array_merge( $this->default_headers, $headers );

		if ( $method === 'POST' && !isset( $headers['Content-Type'] ) ) {
			$headers['Content-Type'] = 'application/x-www-form-urlencoded';
		}

		foreach ( $headers as $header_name => $header_value ) {
			$options['http']['header'] .= "$header_name: $header_value\r\n";
		}

		if ( !empty( $body ) ) {
			$options['http']['content'] = http_build_query( $body );
		}

		$context = stream_context_create( $options );
		return $context;
	}

	private function parse_headers( array $headers ) {
		$parsed = [];

		$response_code = array_shift( $headers );
		if ( preg_match( '#HTTP/[0-9\.]+\s+([0-9]+)#', $response_code, $matches ) ) {
			$headers[] = 'response_code: ' . intval( $matches[1] );
		}
		var_export( $headers );

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

	private function set_error_handler() {
		set_error_handler(
			function (
				int $errno,
				string $errfile,
				string $errline,
				int $errcontext
			) : bool|null {
				return null;
			}
		);
	}
}
