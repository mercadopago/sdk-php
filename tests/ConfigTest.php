<?php

namespace MercadoPago;
use Exception;

class ConfigTest
    extends \PHPUnit_Framework_TestCase
{
    protected $config;

    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    /**
     * @covers                   Config::load()
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
     * @covers                   Config::load()
     * @covers                   Config::set()
     * @covers                   Config::get()
     */
    public function testDifferentSetField()
    {
        $config = Config::load();
        $config->set('base_url_wrong', "https://custom.com");
        $this->assertEquals($config->get('base_url'), "https://api.mercadopago.com");
    }

    /**
     * @covers                   Config::load()
     * @covers                   Config::get()
     */
    public function testDefaultSettingsWithInvalidPath()
    {
        $config = Config::load('./spec/settings_wrong.yml');
        $this->assertEquals($config->get('base_url'), 'https://api.mercadopago.com');
    }

    /**
     * @covers            Config::load()
     * @covers            Config::configure()
     * @covers            Config::get()
     */
    public function testSettingsFromArray()
    {
        $config = Config::load();
        $config->configure(['base_url'      => 'https://custom.com',
                            'CLIENT_ID'     => 'RANDOM_ID',
                            'APP_ID'        => 'APP_ID',
                            'ACCESS_TOKEN'  => 'RANDOM_TOKEN']
        );
        $this->assertEquals($config->get('base_url'), 'https://custom.com');
        $this->assertEquals($config->get('CLIENT_ID'), 'RANDOM_ID');
        $this->assertEquals($config->get('APP_ID'), 'APP_ID');
        $this->assertEquals($config->get('ACCESS_TOKEN'), 'RANDOM_TOKEN');
    }

    /**
     * @covers Config::load()
     * @covers Config::get()
     */
    public function testSettingsFromYml()
    {
        $config = Config::load(dirname(__FILE__) . '/settings.yml');
        $this->assertEquals('CLIENT_ID_YAML', $config->get('CLIENT_ID'));
        $this->assertEquals('CLIENT_SECRET_YAML', $config->get('CLIENT_SECRET'));
        $this->assertEquals('CLIENT_ACCESS_TOKEN_YAML', $config->get('ACCESS_TOKEN'));
    }

    /**
     * @covers Config::load()
     * @covers Config::get()
     */
    public function testNonExistentValueCall()
    {
        $config = Config::load();
        $this->assertEquals(null, $config->get('wrong_config_key'));
    }
}