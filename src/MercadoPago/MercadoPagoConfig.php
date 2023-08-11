<?php

namespace MercadoPago;

use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Net\MPHttpClient;

/** Mercado Pago configuration class. */
class MercadoPagoConfig
{
    /** @var string Mercado Pago SDK version. */
    public static string $CURRENT_VERSION = "3.0.0";

    /** @var string Mercado Pago Base URL */
    public static string $BASE_URL = "https://api.mercadopago.com";

    /** @var string Mercado Pago SDK PHP product version */
    public static string $PRODUCT_ID = "BC32A7RU643001OI3940";

    /** @var string access token */
    private static string $access_token = "";

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
}
