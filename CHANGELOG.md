# Changelog

## ????
- Provide default HTTP options
- Default to HTTP/1.1
- Run PHP lint as part of the tests

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
