<?php

namespace MercadoPago\Exceptions;

use MercadoPago\Net\MPResponse;

/**
 * Thrown when the API returns HTTP 429 Too Many Requests.
 * Exposes the Retry-After header value (in seconds) when present.
 */
class MPRateLimitException extends MPApiException
{
    private ?int $retry_after;

    public function __construct(string $message, MPResponse $response, ?int $retry_after = null)
    {
        parent::__construct($message, $response);
        $this->retry_after = $retry_after;
    }

    /** Returns seconds to wait before retrying, or null if the Retry-After header was absent. */
    public function getRetryAfter(): ?int
    {
        return $this->retry_after;
    }
}
