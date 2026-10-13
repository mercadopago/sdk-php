# Handle API and transport errors

Catch the most specific SDK exception on which the application can act. `MPApiException` remains the common API-response fallback.

```php
try {
    $order = $client->create($request, $options);
} catch (MPRateLimitException $error) {
    error_log('Mercado Pago rate limit reached');
} catch (MPApiException $error) {
    error_log('Mercado Pago status: ' . $error->getStatusCode());
}
```

Choose recovery from the category, not only the message:

| Category | Application decision |
|---|---|
| Authentication or forbidden | Stop; correct credentials or permissions. |
| Bad request or validation | Correct the input; an identical retry will fail. |
| Idempotency | Keep the original key and reconcile the original operation. |
| Rate limit | Wait according to server guidance and reduce concurrency. |
| Dependency, locked resource, or server | Retry only within a bounded policy. |
| Transport/connection failure | Treat a write as potentially completed and reconcile first. |

The SDK exposes typed exceptions for authentication, idempotency, validation, locked resources, rate limits, dependencies, and server failures. Keep a broad final catch only where you can add context and rethrow or convert it predictably.

Log exception type, HTTP status, operation, request ID when available, and your correlation ID. Never log access tokens, card data, complete payloads, or full API responses.
