<?php

namespace MercadoPago\Core;

/** MPRequestOptions class. */
class MPRequestOptions
{
    public $access_token;

    public $connection_timeout;

    public $custom_headers;

    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    public function setAccessToken($access_token): void
    {
        $this->$access_token = $access_token;
    }

    public function getConnectionTimeout(): int
    {
        return $this->connection_timeout;
    }

    public function setConnectionTimeout($connection_timeout): void
    {
        $this->$connection_timeout = $connection_timeout;
    }

    public function getCustomHeaders(): array
    {
        return $this->custom_headers;
    }

    public function setCustomHeaders($custom_headers): void
    {
        $this->$custom_headers = $custom_headers;
    }
}
