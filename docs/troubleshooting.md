# Troubleshooting

## Requests take longer than expected

The connection timeout applies to each attempt, while retry delays add elapsed time. Review `connectionTimeout`, `maxRetries`, backoff settings, and retries performed by the queue or framework.

## A write ended with a connection failure

The result is unknown, not necessarily failed. Query by resource ID or external reference before repeating the same payload with the same idempotency key.

## A custom header is missing

`setCustomHeaders()` expects a list such as `['X-Idempotency-Key: value']`. An associative array like `['X-Idempotency-Key' => 'value']` does not match the SDK format.

## Webhook validation fails

Confirm that the web server forwards unchanged `x-request-id` and `data.id` values, then check clock synchronization and the endpoint secret. Do not validate unsigned QR Code notifications.

## Escalating an issue

Include SDK and PHP versions, operation, HTTP status, request ID, sanitized exception type/message, and a minimal reproduction. Open a repository issue without credentials, card data, webhook secrets, or exploit details.
