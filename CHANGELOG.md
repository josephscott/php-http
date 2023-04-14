# Changelog

## ????
- Notes on how to use the HTTP object and class
- Provide return types
- New test for changing the default user agent
- Support for HEAD requests via head() method

## 0.0.4 - 2023-04-12
- Github Actions for tests
- Static method, HTTP::g() for GET
- New test for HTTP::g()
- Static method, HTTP::p() for POST
- New test for HTTP::p()
- New simple PHP server that the tests run against, all tests have been updated to use it

## 0.0.3 - 2023-04-10
- Provide default HTTP options
- Default to HTTP/1.1
- Run PHP lint as part of the tests
- Use the `ignore_errors` option instead of the error handler to capture response error conditions
- New test: `get: fail, 500`
- Add timeout support, defaults to 90 seconds
- New test: `get: timeout`
- New public method: request().  This centralizes the file_get_contents() call into one place.
- Update the get() and post() methods to use the new request() method
- Track the total time a request took
- New test: `get: slow`, make sure total time tracking works

## 0.0.2 - 2023-04-08
- Rename to HTTP
- Lowercase all response header names
- Set types for function args
- Add support for custom request headers
- Move everything to a single class
- Add private build_context() method
- List of default request headers, currently user_agent and accept
- Include the HTTP response code in the list of response headers
- Testing with phpstan
- Testing with pest
- Handle PHP warnings with failed HTTP requests

## 0.0.1 - 2023-04-06
- Basic minimal working version
