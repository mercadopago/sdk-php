<?php

namespace MercadoPago\Net;

/** MPRequest class. */
class MPRequest
{
    /**
     * MPRequest constructor.
     * @param string $uri path to be requested.
     * @param string $method method to be used.
     * @param string $payload payload to be sent.
     * @param array $headers headers to be sent.
     * @param int $connection_timeout connection timeout to be sent.
     */
    public function __construct(
        private string $uri,
        private string $method,
        private ?string $payload = null,
        private ?array $headers = null,
        private ?int $connection_timeout = null
    ) {
    }

    /**
     * Get method.
     * @return string method.
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Get uri.
     * @return string uri.
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Get headers.
     * @return array headers.
     */
    public function getHeaders(): ?array
    {
        return $this->headers;
    }

    /**
     * Get payload.
     * @return string payload.
     */
    public function getPayload(): ?string
    {
        return $this->payload;
    }

    /**
     * Get connection timeout.
     * @return int connection timeout.
     */
    public function getConnectionTimeout(): ?int
    {
        return $this->connection_timeout;
    }
}
