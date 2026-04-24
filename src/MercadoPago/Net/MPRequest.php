<?php

namespace MercadoPago\Net;

/**
 * Immutable value object representing an HTTP request to be sent to the MercadoPago API.
 *
 * Built by {@see \MercadoPago\Client\MercadoPagoClient::buildRequest()} and consumed
 * by {@see MPHttpClient::send()}. Contains the API path, HTTP verb, serialized JSON
 * payload, assembled headers (auth, tracking, idempotency), and timeout settings.
 */
class MPRequest
{
    /**
     * @param string      $uri                API path (e.g., "/v1/payments"). The base URL is prepended by the HTTP client.
     * @param string      $method             HTTP verb — one of {@see HttpMethod} constants.
     * @param string|null $payload             JSON-encoded request body, or null for bodyless requests (GET, DELETE).
     * @param array<int,string>|null $headers  Fully-assembled HTTP headers including auth and tracking.
     * @param int|null    $connection_timeout  Connection timeout in milliseconds. Falls back to {@see \MercadoPago\MercadoPagoConfig::getConnectionTimeout()}.
     */
    public function __construct(
        private string $uri,
        private string $method,
        private ?string $payload = null,
        private ?array $headers = null,
        private ?int $connection_timeout = null
    ) {
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    /** @return array<int,string>|null */
    public function getHeaders(): ?array
    {
        return $this->headers;
    }

    public function getPayload(): ?string
    {
        return $this->payload;
    }

    /** @return int|null Timeout in milliseconds. */
    public function getConnectionTimeout(): ?int
    {
        return $this->connection_timeout;
    }
}
