<?php
namespace MercadoPago;

/**
 * MercadoPagoSdk Class Doc Comment
 *
 * @package MercadoPago
 */
class MercadoPagoSdk
{

    /**
     * @var Config
     */
    protected static $_config;
    /**
     * @var Manager
     */
    protected static $_manager;

    /**
     * @var
     */
    protected static $_restClient;

    /**
     * MercadoPagoSdk constructor.
     */
    public static function initialize()
    {
        self::$_restClient = new RestClient();
        self::$_config = new Config(null, self::$_restClient);
        self::$_restClient->setHttpParam('address', self::$_config->get('base_url'));
        self::$_manager = new Manager(self::$_restClient, self::$_config);
        Entity::setManager(self::$_manager);
    }

    /**
     * @return Config
     */
    public static function config()
    {
        return self::$_config;
    }

}

