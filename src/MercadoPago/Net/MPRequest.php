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

    // --- Optional per-request retry config (set by MercadoPagoClient after construction) ---

    private ?int $max_retries = null;
    private ?array $retry_on = null;
    private ?int $initial_delay_ms = null;
    private ?int $max_delay_ms = null;
    private ?bool $jitter = null;
    private $on_retry = null;

    public function getMaxRetries(): ?int { return $this->max_retries; }
    public function setMaxRetries(?int $v): void { $this->max_retries = $v; }

    public function getRetryOn(): ?array { return $this->retry_on; }
    public function setRetryOn(?array $v): void { $this->retry_on = $v; }

    public function getInitialDelayMs(): ?int { return $this->initial_delay_ms; }
    public function setInitialDelayMs(?int $v): void { $this->initial_delay_ms = $v; }

    public function getMaxDelayMs(): ?int { return $this->max_delay_ms; }
    public function setMaxDelayMs(?int $v): void { $this->max_delay_ms = $v; }

    public function getJitter(): ?bool { return $this->jitter; }
    public function setJitter(?bool $v): void { $this->jitter = $v; }

    public function getOnRetry() { return $this->on_retry; }
    public function setOnRetry($v): void { $this->on_retry = $v; }
}
