<?php

namespace MercadoPago\Core;

/** MPRequestOptions class. */
class MPRequestOptions
{
    public ?string $access_token;

    public ?int $connection_timeout;

    public ?array $custom_headers;

    public function __construct(?string $access_token = null, ?int $connection_timeout = null, ?array $custom_headers = null)
    {
        $this->access_token = $access_token;
        $this->connection_timeout = $connection_timeout;
        $this->custom_headers = $custom_headers;
    }

    public function getAccessToken(): string | null
    {
        return $this->access_token;
    }

    public function setAccessToken(string $access_token): void
    {
        $this->access_token = $access_token;
    }

    public function getConnectionTimeout(): int | null
    {
        return $this->connection_timeout;
    }

    public function setConnectionTimeout(int $connection_timeout): void
    {
        $this->connection_timeout = $connection_timeout;
    }

    public function getCustomHeaders(): array | null
    {
        return $this->custom_headers;
    }

    public function setCustomHeaders(array $custom_headers): void
    {
        $this->custom_headers = $custom_headers;
    }
}
