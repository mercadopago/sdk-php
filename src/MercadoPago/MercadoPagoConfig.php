<?php

namespace MercadoPago;

use MercadoPago\Exceptions\InvalidArgumentException;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Net\MPHttpClient;

/** Mercado Pago configuration class. */
class MercadoPagoConfig
{
    /** @var string Mercado Pago SDK version. */
    public static string $CURRENT_VERSION = "3.5.1";
  
    /** @var string Mercado Pago Base URL */
    public static string $BASE_URL = "https://api.mercadopago.com";

    /** @var string Mercado Pago SDK PHP product version */
    public static string $PRODUCT_ID = "BC32A7RU643001OI3940";

    /** @var string Class constant for local runtime enviroment */
    public const LOCAL = 'local';

    /** @var string Class constant for server runtime enviroment */
    public const SERVER = 'server';

    /** @var string Actual enviroment the user is running at. Default is SERVER */
    private static string $runtime_enviroment = self::SERVER;

    /** @var string access token */
    private static string $access_token = "";

    /** @var string integrator id */
    private static string $integrator_id = "";

    /** @var string corporation id */
    private static string $corporation_id = "";

    /** @var string platform id */
    private static string $platform_id = "";

    /** @var int max retries */
    private static int $max_retries = 3;

    /** @var int retry delay (in milliseconds) */
    private static int $retry_delay = 500;

    /** @var int max connections */
    private static int $max_connections = 10;

    /** @var int connection timeout */
    private static int $connection_timeout = 20000;

    /** @var MPHttpClient http client */
    private static ?MPHttpClient $http_client = null;

    /**
     * Verifies which http client use.
     * @return \MercadoPago\Net\MPHttpClient
     */
    public static function getHttpClient(): MPHttpClient
    {
        if (self::$http_client == null) {
            self::$http_client = new MPDefaultHttpClient();
        }
        return self::$http_client;
    }

    /**
     * Sets http client.
     * @param \MercadoPago\Net\MPHttpClient $http_client http client
     */
    public static function setHttpClient(MPHttpClient $http_client): void
    {
        self::$http_client = $http_client;
    }

    /**
     * Gets access token.
     * @return string access token
     */
    public static function getAccessToken(): string
    {
        return self::$access_token;
    }

    /**
     * Sets access token.
     * @param string $access_token access token
     * @return void access token
     */
    public static function setAccessToken(string $access_token): void
    {
        self::$access_token = $access_token;
    }

    /**
     * Gets integrator id.
     * @return string integrator id
     */
    public static function getIntegratorId(): string
    {
        return self::$integrator_id;
    }

    /**
     * Sets integrator id.
     * @param string $integrator_id integrator id
     * @return void integrator id
     */
    public static function setIntegratorId(string $integrator_id): void
    {
        self::$integrator_id = $integrator_id;
    }

    /**
     * Gets corporation id.
     * @return string corporation id
     */
    public static function getCorporationId(): string
    {
        return self::$corporation_id;
    }

    /**
     * Sets corporation id.
     * @param string $corporation_id corporation id
     * @return void corporation id
     */
    public static function setCorporationId(string $corporation_id): void
    {
        self::$corporation_id = $corporation_id;
    }

    /**
     * Gets platform id.
     * @return string platform id
     */
    public static function getPlatformId(): string
    {
        return self::$platform_id;
    }

    /**
     * Sets platform id.
     * @param string $platform_id platform id
     * @return void platform id
     */
    public static function setPlatformId(string $platform_id): void
    {
        self::$platform_id = $platform_id;
    }

    /**
     * Gets max retries.
     * @return int max retries
     */
    public static function getMaxRetries(): int
    {
        return self::$max_retries;
    }

    /**
     * Sets max retries.
     * @param int $max_retries max retries
     * @return void max retries
     */
    public static function setMaxRetries(int $max_retries): void
    {
        self::$max_retries = $max_retries;
    }

    /**
     * Gets retry delay.
     * @return int retry delay
     */
    public static function getRetryDelay(): int
    {
        return self::$retry_delay;
    }

    /**
     * Sets retry delay.
     * @param int $retry_delay retry delay
     * @return void retry delay
     */
    public static function setRetryDelay(int $retry_delay): void
    {
        self::$retry_delay = $retry_delay;
    }

    /**
     * Gets max connections.
     * @return int max connections
     */
    public static function getMaxConnections(): int
    {
        return self::$max_connections;
    }

    /**
     * Sets max connections.
     * @param int $max_connections max connections
     * @return void max connections
     */
    public static function setMaxConnections(int $max_connections): void
    {
        self::$max_connections = $max_connections;
    }

    /**
     * Gets connection timeout.
     * @return int connection timeout
     */
    public static function getConnectionTimeout(): int
    {
        return self::$connection_timeout;
    }

    /**
     * Sets connection timeout.
     * @param int $connection_timeout connection timeout
     * @return void connection timeout
     */
    public static function setConnectionTimeout(int $connection_timeout): void
    {
        self::$connection_timeout = $connection_timeout;
    }

    /**
     * Gets the enviroment the user is running at.
     * @return string enviroment
     */
    public static function getRuntimeEnviroment(): string
    {
        return self::$runtime_enviroment;
    }

    /**
     * Sets the enviroment the user is running at.
     * @param string $enviroment one of the ENVIROMENT_TYPES
     * @return void
     */
    public static function setRuntimeEnviroment(string $enviroment): void
    {
        if ($enviroment != self::LOCAL && $enviroment != self::SERVER) {
            throw new InvalidArgumentException("Enviroment must be equal to MercadoPagoConfig::LOCAL or MercadoPagoConfig::SERVER.");
        }
        self::$runtime_enviroment = $enviroment;
    }
}
