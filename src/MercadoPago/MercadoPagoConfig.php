<?php

namespace MercadoPago;

use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Net\MPHttpClient;

/** Mercado Pago configuration class. */
class MercadoPagoConfig
{

    public static $CURRENT_VERSION = "3.0.0.";

    public static $BASE_URL = "https://api.mercadopago.com";

    public static $PRODUCT_ID = "BC32A7RU643001OI3940";

    private static $access_token = "";

    private static $platform_id;

    private static $corporation_id;

    private static $integrator_id;

    private static $max_connections = 10;

    private static $connection_timeout = 20000;

    private static $http_client;

    public static function getHttpClient(): MPHttpClient
    {
        self::$http_client = new MPDefaultHttpClient();
        return self::$http_client;
    }

    public static function setHttpClient(MPHttpClient $http_client): void
    {
        self::$http_client = $http_client;
    }

    public static function getAccessToken(): string
    {
        return self::$access_token;
    }

    public static function setAccessToken(string $access_token): void
    {
        self::$access_token = $access_token;
    }

    public static function getPlatformId(): string
    {
        return self::$platform_id;
    }

    public static function setPlatformId(string $platform_id): void
    {
        self::$platform_id = $platform_id;
    }

    public static function getCorporationId(): string
    {
        return self::$corporation_id;
    }

    public static function setCorporationId(string $corporation_id): void
    {
        self::$corporation_id = $corporation_id;
    }

    public static function getIntegratorId(): string
    {
        return self::$integrator_id;
    }

    public static function setIntegratorId(string $integrator_id): void
    {
        self::$integrator_id = $integrator_id;
    }

    public static function getMaxConnections(): int
    {
        return self::$max_connections;
    }

    public static function setMaxConnections(int $max_connections): void
    {
        self::$max_connections = $max_connections;
    }

    public static function getConnectionTimeout(): int
    {
        return self::$connection_timeout;
    }

    public static function setConnectionTimeout(int $connection_timeout): void
    {
        self::$connection_timeout = $connection_timeout;
    }
}
