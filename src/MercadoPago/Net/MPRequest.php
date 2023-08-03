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

    /**
     * MPRequest constructor.
     * @param string $uri path to be requested.
     * @param string $method method to be used.
     * @param mixed $payload payload to be sent.
     * @param mixed $headers headers to be sent.
     * @param mixed $connection_timeout connection timeout to be sent.
     */
    public function __construct(string $uri, string $method, ?string $payload = null, ?array $headers = null, ?int $connection_timeout = null)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->payload = $payload;
        $this->headers = $headers;
        $this->connection_timeout = $connection_timeout;
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
