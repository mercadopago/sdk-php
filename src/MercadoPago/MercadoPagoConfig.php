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

    private static $accessToken = "";

    private static $platformId;

    private static $corporationId;

    private static $integratorId;

    private static $maxConnections = 10;

    private static $connectionTimeout = 20000;

    private static $httpClient;

    public static function getHttpClient(): MPHttpClient
    {
        self::$httpClient = new MPDefaultHttpClient();
        return self::$httpClient;
    }

    public static function setHttpClient(MPHttpClient $httpClient): void
    {
        self::$httpClient = $httpClient;
    }

    public static function getAccessToken(): string
    {
        return self::$accessToken;
    }

    public static function setAccessToken(string $accessToken): void
    {
        self::$accessToken = $accessToken;
    }

    public static function getPlatformId(): string
    {
        return self::$platformId;
    }

    public static function setPlatformId(string $platformId): void
    {
        self::$platformId = $platformId;
    }

    public static function getCorporationId(): string
    {
        return self::$corporationId;
    }

    public static function setCorporationId(string $corporationId): void
    {
        self::$corporationId = $corporationId;
    }

    public static function getIntegratorId(): string
    {
        return self::$integratorId;
    }

    public static function setIntegratorId(string $integratorId): void
    {
        self::$integratorId = $integratorId;
    }

    public static function getMaxConnections(): int
    {
        return self::$maxConnections;
    }

    public static function setMaxConnections(int $maxConnections): void
    {
        self::$maxConnections = $maxConnections;
    }

    public static function getConnectionTimeout(): int
    {
        return self::$connectionTimeout;
    }

    public static function setConnectionTimeout(int $connectionTimeout): void
    {
        self::$connectionTimeout = $connectionTimeout;
    }
}
