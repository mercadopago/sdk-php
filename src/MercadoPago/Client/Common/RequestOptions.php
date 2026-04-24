<?php

namespace MercadoPago\Client\Common;

/**
 * Per-request configuration overrides for MercadoPago API calls.
 *
 * Allows overriding the global access token, connection timeout, and headers
 * on a per-request basis. When provided to a client method, these values
 * take precedence over {@see \MercadoPago\MercadoPagoConfig} defaults.
 *
 * ```php
 * $options = new RequestOptions();
 * $options->setAccessToken("APP_USR-other-token");
 * $payment = $client->create($data, $options);
 * ```
 */
class RequestOptions
{
    /**
     * @param string|null $access_token     OAuth Bearer token override. Falls back to {@see \MercadoPago\MercadoPagoConfig::getAccessToken()}.
     * @param int|null    $connection_timeout Timeout in milliseconds override. Falls back to global config.
     * @param array<string,string>|null $custom_headers Additional HTTP headers merged into the request.
     */
    public function __construct(
        private ?string $access_token = null,
        private  ?int $connection_timeout = null,
        private  ?array $custom_headers = null
    ) {
    }

    public function getAccessToken(): string | null
    {
        return $this->access_token;
    }

    public function setAccessToken(string $access_token): void
    {
        $this->access_token = $access_token;
    }

    /** @return int|null Timeout in milliseconds. */
    public function getConnectionTimeout(): int | null
    {
        return $this->connection_timeout;
    }

    /** @param int $connection_timeout Timeout in milliseconds. */
    public function setConnectionTimeout(int $connection_timeout): void
    {
        $this->connection_timeout = $connection_timeout;
    }

    /** @return array<string,string>|null */
    public function getCustomHeaders(): array | null
    {
        return $this->custom_headers;
    }

    /** @param array<string,string> $custom_headers Key-value pairs of HTTP headers. */
    public function setCustomHeaders(array $custom_headers): void
    {
        $this->custom_headers = $custom_headers;
    }
}
