<?php

namespace MercadoPago\Net;

/**
 * Immutable value object wrapping the MercadoPago API HTTP response.
 *
 * Created by {@see MPDefaultHttpClient::makeRequest()} after executing a cURL call.
 * Contains the HTTP status code and the JSON-decoded response body as an associative array.
 */
class MPResponse
{
    /**
     * @param int        $status_code HTTP status code (e.g., 200, 400, 500).
     * @param array|null $content     JSON-decoded response body as an associative array, or null if empty.
     */
    public function __construct(
        private int $status_code,
        private ?array $content
    ) {
    }

    public function getStatusCode(): int
    {
        return $this->status_code;
    }

    /** @return array<string,mixed> Decoded JSON body. */
    public function getContent(): array
    {
        return $this->content;
    }
}
