<?php

namespace MercadoPago\Client\Common;

/** RequestOptions class. */
class RequestOptions
{
    /**
     * RequestOptions constructor.
     * @param string|null $access_token access token to be used.
     * @param int|null $connection_timeout connection timeout to be used.
     * @param array|null $custom_headers custom headers to be used.
     */
    public function __construct(
        private ?string $access_token = null,
        private  ?int $connection_timeout = null,
        private  ?array $custom_headers = null
    ) {
    }

    /**
     * Get access token.
     * @return string|null access token.
     */
    public function getAccessToken(): string | null
    {
        return $this->access_token;
    }

    /**
     * Set access token.
     * @param string $access_token access token to be set.
     * @return void access token.
     */
    public function setAccessToken(string $access_token): void
    {
        $this->access_token = $access_token;
    }

    /**
     * Get connection timeout.
     * @return int|null connection timeout.
     */
    public function getConnectionTimeout(): int | null
    {
        return $this->connection_timeout;
    }

    /**
     * Set connection timeout.
     * @param int $connection_timeout connection timeout to be set.
     * @return void connection timeout.
     */
    public function setConnectionTimeout(int $connection_timeout): void
    {
        $this->connection_timeout = $connection_timeout;
    }

    /**
     * Get custom headers.
     * @return array|null custom headers.
     */
    public function getCustomHeaders(): array | null
    {
        return $this->custom_headers;
    }

    /**
     * Set custom headers.
     * @param array $custom_headers custom headers to be set.
     * @return void custom headers.
     */
    public function setCustomHeaders(array $custom_headers): void
    {
        $this->custom_headers = $custom_headers;
    }
}
