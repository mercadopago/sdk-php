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
    /** Default maximum number of retry attempts for retryable status codes. */
    const DEFAULT_MAX_RETRIES = 3;

    /** Default connection timeout in milliseconds (60 seconds). */
    const DEFAULT_TIMEOUT_MS = 60000;

    /** Default maximum delay between retries in milliseconds (30 seconds). */
    const DEFAULT_MAX_DELAY_MS = 30000;

    /** Default HTTP status codes that trigger a retry. */
    const DEFAULT_RETRY_ON = [429, 500, 502, 503, 504];

    /** @var int|null Maximum retries; null = use MercadoPagoConfig global. */
    private ?int $max_retries = null;

    /** @var array<int>|null Status codes to retry; null = DEFAULT_RETRY_ON. */
    private ?array $retry_on = null;

    /** @var int|null Initial backoff delay in ms; null = no extra delay. */
    private ?int $initial_delay_ms = null;

    /** @var int|null Max backoff delay in ms; null = DEFAULT_MAX_DELAY_MS. */
    private ?int $max_delay_ms = null;

    /** @var bool|null Add random jitter to delay. */
    private ?bool $jitter = null;

    /** @var callable|null Callback(int $attempt, \Throwable $error): void invoked before each retry. */
    private $on_retry = null;

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

    /**
     * Returns the per-request access token override.
     *
     * @return string|null OAuth Bearer token, or null to use the global default.
     */
    public function getAccessToken(): string | null
    {
        return $this->access_token;
    }

    /**
     * Overrides the access token for this request only.
     *
     * @param string $access_token OAuth Bearer token (e.g., "APP_USR-..." or "TEST-...").
     */
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

    public function getMaxRetries(): ?int { return $this->max_retries; }

    /** @throws \InvalidArgumentException if $v is negative */
    public function setMaxRetries(int $v): void
    {
        if ($v < 0) {
            throw new \InvalidArgumentException("max_retries must be >= 0, got: $v");
        }
        $this->max_retries = $v;
    }

    /** @return array<int>|null */
    public function getRetryOn(): ?array { return $this->retry_on; }

    /** @param array<int> $codes
     * @throws \InvalidArgumentException if any code is outside 100-599 */
    public function setRetryOn(array $codes): void
    {
        foreach ($codes as $code) {
            if ($code < 100 || $code > 599) {
                throw new \InvalidArgumentException("Invalid HTTP status code in retry_on: $code");
            }
        }
        $this->retry_on = $codes;
    }

    public function getInitialDelayMs(): ?int { return $this->initial_delay_ms; }

    /** @throws \InvalidArgumentException if $v is negative */
    public function setInitialDelayMs(int $v): void
    {
        if ($v < 0) {
            throw new \InvalidArgumentException("initial_delay_ms must be >= 0, got: $v");
        }
        $this->initial_delay_ms = $v;
    }

    public function getMaxDelayMs(): ?int { return $this->max_delay_ms; }

    /** @throws \InvalidArgumentException if $v is negative */
    public function setMaxDelayMs(int $v): void
    {
        if ($v < 0) {
            throw new \InvalidArgumentException("max_delay_ms must be >= 0, got: $v");
        }
        $this->max_delay_ms = $v;
    }

    public function getJitter(): ?bool { return $this->jitter; }

    public function setJitter(bool $v): void { $this->jitter = $v; }

    /** @return callable|null */
    public function getOnRetry() { return $this->on_retry; }

    /** @param callable $callback function(int $attempt, \Throwable $error): void */
    public function setOnRetry(callable $callback): void { $this->on_retry = $callback; }
}
