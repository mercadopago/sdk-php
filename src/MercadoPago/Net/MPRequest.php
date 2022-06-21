<?php

namespace MercadoPago\Net;

/** MPRequest class. */
class MPRequest
{
    private $uri;

    private $method;

    private $headers;

    private $payload;

    private $connection_timeout;

    /** MPRequest constructor. */
    public function __construct(string $uri, string $method, ?string $payload = null, ?array $headers = null, ?int $connection_timeout = null)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->payload = $payload;
        $this->headers = $headers;
        $this->connection_timeout = $connection_timeout;
    }

    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getHeaders(): ?array
    {
        return $this->headers;
    }

    public function getPayload(): ?string
    {
        return $this->payload;
    }

    public function getConnectionTimeout(): ?int
    {
        return $this->connection_timeout;
    }
}
