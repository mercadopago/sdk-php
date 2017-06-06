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
    
    
    // Publishing generic functions 
    
    public static function get($uri, $options=[]){
      if ( self::$_config->get('ACCESS_TOKEN')){
        $uri = $uri . "?access_token=" . self::$_config->get('ACCESS_TOKEN');
      } 
      return self::$_restClient->get($uri, $options);
    }
    
    public static function post($uri, $options=[]){
      if ( self::$_config->get('ACCESS_TOKEN')){
        $uri = $uri . "?access_token=" . self::$_config->get('ACCESS_TOKEN');
      }
      return self::$_restClient->post($uri, $options);
    }
    
    public static function put($uri, $options=[]){
      if ( self::$_config->get('ACCESS_TOKEN')){
        $uri = $uri . "?access_token=" . self::$_config->get('ACCESS_TOKEN');
      }
      return self::$_restClient->put($uri, $options);
    }
    
    public static function delete($uri, $options=[]){
      if ( self::$_config->get('ACCESS_TOKEN')){
        $uri = $uri . "?access_token=" . self::$_config->get('ACCESS_TOKEN');
      }
      return self::$_restClient->deleted($uri, $options);
    }

}

