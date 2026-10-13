# Validate and process webhooks

Validate signed notifications before trusting their identifiers:

```php
try {
    WebhookSignatureValidator::validate(
        $_SERVER['HTTP_X_SIGNATURE'] ?? null,
        $_SERVER['HTTP_X_REQUEST_ID'] ?? null,
        $_GET['data.id'] ?? null,
        $_ENV['MP_WEBHOOK_SECRET'],
        300
    );
} catch (InvalidWebhookSignatureException $error) {
    http_response_code(401);
    exit;
}
```

Pass `x-signature`, `x-request-id`, and `data.id` exactly as received. Trimming, decoding, or normalizing them before validation can change the signed manifest. QR Code notifications are not signed and must not use this validator.

A production endpoint should:

1. Extract the raw validation inputs.
2. Validate the signature and timestamp tolerance.
3. Deduplicate by notification or resource identifier.
4. Enqueue the identifier and acknowledge promptly.
5. Fetch the current resource from Mercado Pago in a worker.
6. Apply state transitions idempotently because delivery can repeat or arrive out of order.

Use the notification as a signal and the API resource as the current state. Keep server clocks synchronized. Record a sanitized validation result, but never the webhook secret or complete signature.
