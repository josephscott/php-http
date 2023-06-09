# Changelog

## 0.1.1 - 2023-04-21
- Work with composer via classmap

## 0.1.0 - 2023-04-20
- Major changes to the API, reducing the amount of code and making the API more consistent across the static and object methods
- Static tests have been merged into a single set per verb
- Readme examples have been updated to use the new API
- Simplify body encoding checks
- Makefile test failure cleanup improved
- Add `Connection: close` to the default headers to avoid keep-alive delays
- Limit HTTP calls to the list of known methods
- Reduce the `get: slow` sleep time, reducing the amount of time the test run takes
- New tests for delete() method

## 0.0.6 - 2023-04-18
- Support for PUT requests via put() method
- New test for put() method
- Support for PUT requests via pu() method
- New test for pu() method

## 0.0.5 - 2023-04-14
- Notes on how to use the HTTP object and class
- Provide return types
- New test for changing the default user agent
- Support for HEAD requests via head() method
- New test for head() method
- Support for HEAD requests via h() method
- New test for h() method
- New test for get with a URL that has no web server running

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
