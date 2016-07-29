<?php

namespace MercadoPago;

/**
 * ConfigTest Class Doc Comment
 *
 * @package MercadoPago
 */
class ConfigTest
    extends \PHPUnit_Framework_TestCase
{
    /**
     * @var
     */
    protected $config;

    /**
     *
     */
    protected function setUp()
    {
    }

    /**
     *
     */
    protected function tearDown()
    {
    }

    /**
     * @covers                   \MercadoPago\Config::load
     * @covers                   \MercadoPago\Config::__construct
     * @covers                   \MercadoPago\Config\AbstractConfig::__construct
     * @covers                   \MercadoPago\Config::getDefaults
     * @covers                   \MercadoPago\Config\AbstractConfig::get
     * @covers                   \MercadoPago\Config\AbstractConfig::has
     */
    public function testDefaultSettings()
    {
        $config = Config::load();
        $this->assertEquals('https://api.mercadopago.com', $config->get('base_url'));
        $this->assertEquals($config->get('sandbox_mode'), true);
        $this->assertEquals($config->get('CLIENT_ID'), "");
        $this->assertEquals($config->get('CLIENT_SECRET'), "");
        $this->assertEquals($config->get('ACCESS_TOKEN'), "");
        $this->assertEquals($config->get('APP_ID'), "");
    }

    /**
     * @covers                   \MercadoPago\Config::load
     * @covers                   \MercadoPago\Config::set
     * @covers                   \MercadoPago\Config::__construct
     * @covers                   \MercadoPago\Config::getDefaults
     * @covers                   \MercadoPago\Config\AbstractConfig::__construct
     * @covers                   \MercadoPago\Config\AbstractConfig::get
     * @covers                   \MercadoPago\Config\AbstractConfig::set
     * @covers                   \MercadoPago\Config\AbstractConfig::has
     */
    public function testDifferentSetField()
    {
        $config = Config::load();
        $config->set('base_url_wrong', "https://custom.com");
        $this->assertEquals($config->get('base_url'), "https://api.mercadopago.com");
    }

    /**
     * @covers                   \MercadoPago\Config::load
     * @covers                   \MercadoPago\Config::__construct
     * @covers                   \MercadoPago\Config\AbstractConfig::__construct
     * @covers                   \MercadoPago\Config::getDefaults
     * @covers                   \MercadoPago\Config\AbstractConfig::get
     * @covers                   \MercadoPago\Config\AbstractConfig::has
     */
    public function testDefaultSettingsWithInvalidPath()
    {
        $config = Config::load('./spec/settings_wrong.yml');
        $this->assertEquals($config->get('base_url'), 'https://api.mercadopago.com');
    }

    /**
     * @covers                   \MercadoPago\Config::load
     * @covers                   \MercadoPago\Config::set
     * @covers                   \MercadoPago\Config::__construct
     * @covers                   \MercadoPago\Config\AbstractConfig::__construct
     * @covers                   \MercadoPago\Config::getDefaults
     * @covers                   \MercadoPago\Config\AbstractConfig::configure
     * @covers                   \MercadoPago\Config\AbstractConfig::get
     * @covers                   \MercadoPago\Config\AbstractConfig::set
     * @covers                   \MercadoPago\Config\AbstractConfig::has
     */
    public function testSettingsFromArray()
    {
        $config = Config::load();
        $config->configure(['base_url'     => 'https://custom.com',
                            'CLIENT_ID'    => 'RANDOM_ID',
                            'APP_ID'       => 'APP_ID',
                            'ACCESS_TOKEN' => 'RANDOM_TOKEN']
        );
        $this->assertEquals($config->get('base_url'), 'https://custom.com');
        $this->assertEquals($config->get('CLIENT_ID'), 'RANDOM_ID');
        $this->assertEquals($config->get('APP_ID'), 'APP_ID');
        $this->assertEquals($config->get('ACCESS_TOKEN'), 'RANDOM_TOKEN');
    }

    /**
     * @covers                   \MercadoPago\Config::load
     * @covers                   \MercadoPago\Config::__construct
     * @covers                   \MercadoPago\Config\AbstractConfig::__construct
     * @covers                   \MercadoPago\Config::getDefaults
     * @covers                   \MercadoPago\Config\AbstractConfig::has
     * @covers                   \MercadoPago\Config\AbstractConfig::get
     * @covers                   \MercadoPago\Config\Json::getSupportedExtensions
     * @covers                   \MercadoPago\Config\Yaml::getSupportedExtensions
     * @covers                   \MercadoPago\Config\Yaml::parse
     * @covers                   \MercadoPago\Config::_getParser
     */
    public function testSettingsFromYml()
    {
        $config = Config::load(dirname(__FILE__) . '/settings.yml');
        $this->assertEquals('CLIENT_ID_YAML', $config->get('CLIENT_ID'));
        $this->assertEquals('CLIENT_SECRET_YAML', $config->get('CLIENT_SECRET'));
        $this->assertEquals('CLIENT_ACCESS_TOKEN_YAML', $config->get('ACCESS_TOKEN'));
    }

    /**
     * @covers                   \MercadoPago\Config::__construct
     * @covers                   \MercadoPago\Config\AbstractConfig::__construct
     * @covers                   \MercadoPago\Config\AbstractConfig::has
     * @covers                   \MercadoPago\Config::getDefaults
     * @covers                   \MercadoPago\Config::load()
     * @covers                   \MercadoPago\Config::get()
     */
    public function testNonExistentValueCall()
    {
        $config = Config::load();
        $this->assertEquals(null, $config->get('wrong_config_key'));
    }
}