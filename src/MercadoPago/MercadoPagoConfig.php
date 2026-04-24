<?php

namespace MercadoPago;

use MercadoPago\Exceptions\InvalidArgumentException;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Net\MPHttpClient;

/**
 * Global configuration for the MercadoPago PHP SDK.
 *
 * All settings are stored as static properties and apply SDK-wide.
 * At minimum, set the access token before making any API call:
 *
 * ```php
 * MercadoPagoConfig::setAccessToken("APP_USR-...");
 * ```
 *
 * Optional tuning includes retry policy, connection timeouts,
 * and tracking headers for platform integrations.
 */
class MercadoPagoConfig
{
    /** @var string Current SDK version, sent in the User-Agent header. */
    public static string $CURRENT_VERSION = "3.9.0";

    /** @var string Base URL for all API requests. Override only for testing or proxy scenarios. */
    public static string $BASE_URL = "https://api.mercadopago.com";

    /** @var string Internal product identifier sent in the X-Product-Id header. */
    public static string $PRODUCT_ID = "BC32A7RU643001OI3940";

    /** Runtime environment: disables SSL verification for local development. */
    public const LOCAL = 'local';

    /** Runtime environment: production-safe defaults (SSL verification enabled). */
    public const SERVER = 'server';

    /** @var string Current runtime environment. Defaults to SERVER. */
    private static string $runtime_enviroment = self::SERVER;

    /** @var string OAuth access token used for API authentication (Bearer token). */
    private static string $access_token = "";

    /** @var string Integrator ID for tracking MercadoPago partner integrations. */
    private static string $integrator_id = "";

    /** @var string Corporation ID for multi-account corporate setups. */
    private static string $corporation_id = "";

    /** @var string Platform ID for marketplace or e-commerce platform tracking. */
    private static string $platform_id = "";

    /** @var int Maximum retry attempts for failed requests. Default: 3. */
    private static int $max_retries = 3;

    /** @var int Base delay between retries in milliseconds. Actual delay uses exponential backoff. Default: 500ms. */
    private static int $retry_delay = 500;

    /** @var int Maximum concurrent cURL connections (CURLOPT_MAXCONNECTS). Default: 10. */
    private static int $max_connections = 10;

    /** @var int Connection timeout in milliseconds (CURLOPT_CONNECTTIMEOUT_MS). Default: 20000ms. */
    private static int $connection_timeout = 20000;

    /** @var MPHttpClient|null Custom HTTP client. When null, a default cURL-based client is created lazily. */
    private static ?MPHttpClient $http_client = null;

    /**
     * Returns the configured HTTP client, creating a default cURL-based one on first call.
     */
    public static function getHttpClient(): MPHttpClient
    {
        if (self::$http_client == null) {
            self::$http_client = new MPDefaultHttpClient();
        }
        return self::$http_client;
    }

    /**
     * Replaces the default HTTP client with a custom implementation.
     *
     * Useful for injecting mock clients in tests or wrapping requests
     * with custom middleware (logging, metrics, etc.).
     */
    public static function setHttpClient(MPHttpClient $http_client): void
    {
        self::$http_client = $http_client;
    }

    public static function getAccessToken(): string
    {
        return self::$access_token;
    }

    /**
     * Sets the OAuth access token used as Bearer token in all API requests.
     *
     * Must be called before any API interaction. Can be overridden per-request
     * via {@see \MercadoPago\Client\Common\RequestOptions::setAccessToken()}.
     */
    public static function setAccessToken(string $access_token): void
    {
        self::$access_token = $access_token;
    }

    public static function getIntegratorId(): string
    {
        return self::$integrator_id;
    }

    /** @param string $integrator_id Integrator ID assigned by MercadoPago for partner tracking. */
    public static function setIntegratorId(string $integrator_id): void
    {
        self::$integrator_id = $integrator_id;
    }

    public static function getCorporationId(): string
    {
        return self::$corporation_id;
    }

    /** @param string $corporation_id Corporation ID for multi-account corporate setups. */
    public static function setCorporationId(string $corporation_id): void
    {
        self::$corporation_id = $corporation_id;
    }

    public static function getPlatformId(): string
    {
        return self::$platform_id;
    }

    /** @param string $platform_id Platform ID for marketplace or e-commerce platform tracking. */
    public static function setPlatformId(string $platform_id): void
    {
        self::$platform_id = $platform_id;
    }

    public static function getMaxRetries(): int
    {
        return self::$max_retries;
    }

    /** @param int $max_retries Maximum number of retry attempts for failed requests. */
    public static function setMaxRetries(int $max_retries): void
    {
        self::$max_retries = $max_retries;
    }

    public static function getRetryDelay(): int
    {
        return self::$retry_delay;
    }

    /** @param int $retry_delay Base delay between retries in milliseconds (actual delay uses exponential backoff). */
    public static function setRetryDelay(int $retry_delay): void
    {
        self::$retry_delay = $retry_delay;
    }

    public static function getMaxConnections(): int
    {
        return self::$max_connections;
    }

    /** @param int $max_connections Maximum number of concurrent cURL connections. */
    public static function setMaxConnections(int $max_connections): void
    {
        self::$max_connections = $max_connections;
    }

    public static function getConnectionTimeout(): int
    {
        return self::$connection_timeout;
    }

    /** @param int $connection_timeout Connection timeout in milliseconds. */
    public static function setConnectionTimeout(int $connection_timeout): void
    {
        self::$connection_timeout = $connection_timeout;
    }

    public static function getRuntimeEnviroment(): string
    {
        return self::$runtime_enviroment;
    }

    /**
     * Sets the runtime environment. Use {@see self::LOCAL} for development
     * (disables SSL verification) or {@see self::SERVER} for production.
     *
     * @param string $enviroment One of self::LOCAL or self::SERVER.
     * @throws InvalidArgumentException When the value is not LOCAL or SERVER.
     */
    public static function setRuntimeEnviroment(string $enviroment): void
    {
        if ($enviroment != self::LOCAL && $enviroment != self::SERVER) {
            throw new InvalidArgumentException("Enviroment must be equal to MercadoPagoConfig::LOCAL or MercadoPagoConfig::SERVER.");
        }
        self::$runtime_enviroment = $enviroment;
    }
}
