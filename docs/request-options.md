# Request options, retries, and idempotency

Use `RequestOptions` when one call needs limits or headers that differ from the SDK defaults:

```php
$options = new RequestOptions();
$options->setConnectionTimeout(10_000);
$options->setMaxRetries(3);
$options->setJitter(true);
$options->setCustomHeaders([
    'X-Idempotency-Key: order-2026-0001',
]);
```

Custom headers are a list of complete header strings, not an associative array. The retry policy supports a maximum of three attempts by default, configurable retry status codes, bounded backoff, optional jitter, and an `onRetry` callback. Use the callback for sanitized telemetry, not to make another SDK call.

For a write, generate an idempotency key when the business operation begins and persist it with your internal order. Reuse it only for attempts of that exact operation and payload. If a timeout or connection error occurs, query the resource by ID or external reference before repeating the write with the same key; a missing response does not prove the API rejected it.

Coordinate SDK retries with PHP worker, queue, or framework retries so the combined attempts and elapsed time stay bounded. Do not retry authentication or validation failures unchanged, and do not generate a new idempotency key inside a retry loop.
