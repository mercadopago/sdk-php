<?php

namespace MercadoPago;
use Symfony\Component\Config\Definition\Exception\Exception;
 

/**
 * ConfigTest Class Doc Comment
 *
 * @package MercadoPago
 */
class ConfigTest extends \PHPUnit\Framework\TestCase                                                                                       
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
        $restClient = new RestClient();
        $restClient->setHttpRequest($this->_getMockedRequest());

        $config = new Config(dirname(__FILE__) . '/config_files/settings.yml', $restClient);
        $this->assertEquals('CLIENT_ID_YAML', $config->get('CLIENT_ID'));
        $this->assertEquals('CLIENT_SECRET_YAML', $config->get('CLIENT_SECRET'));
        $this->assertEquals('CLIENT_ACCESS_TOKEN_YAML', $config->get('ACCESS_TOKEN'));
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
     * @expectedException        \Exception
     */
    public function testSettingsFromBrokenYml()
    {
        Config::load(dirname(__FILE__) . '/config_files/settings_broken.yml');
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
     * @covers                   \MercadoPago\Config\Json::parse
     * @covers                   \MercadoPago\Config::_getParser
     */
    public function testSettingsFromJson()
    {
        $restClient = new RestClient();
        $restClient->setHttpRequest($this->_getMockedRequest());

        $config = new Config(dirname(__FILE__) . '/config_files/settings.json', $restClient);
        $this->assertEquals('CLIENT_ID_JSON', $config->get('CLIENT_ID'));
        $this->assertEquals('CLIENT_SECRET_JSON', $config->get('CLIENT_SECRET'));
        $this->assertEquals('CLIENT_ACCESS_TOKEN_JSON', $config->get('ACCESS_TOKEN'));
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
     * @covers                   \MercadoPago\Config\Json::parse
     * @covers                   \MercadoPago\Config::_getParser
     * @expectedException        \Exception
     */
    public function testSettingsFromBrokenJson()
    {
        Config::load(dirname(__FILE__) . '/config_files/settings_broken.json');
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
     * @covers                   \MercadoPago\Config\Json::parse
     * @covers                   \MercadoPago\Config::_getParser
     * @covers                   \MercadoPago\Config::all
     */
    public function testGetAll()
    {
        $restClient = new RestClient();
        $restClient->setHttpRequest($this->_getMockedRequest());

        $config = new Config(dirname(__FILE__) . '/config_files/settings.json', $restClient);
        $all = $config->all();
        $this->assertEquals('CLIENT_ID_JSON', $all['CLIENT_ID']);
        $this->assertEquals('CLIENT_SECRET_JSON', $all['CLIENT_SECRET']);
        $this->assertEquals('CLIENT_ACCESS_TOKEN_JSON', $all['ACCESS_TOKEN']);
        $this->assertEquals('https://api.mercadopago.com', $all['base_url']);
        $this->assertEquals(true, $all['sandbox_mode']);
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

   /**
    * @covers                   \MercadoPago\Config::load
    * @covers                   \MercadoPago\Config::__construct
    * @covers                   \MercadoPago\Config\AbstractConfig::__construct
    * @covers                   \MercadoPago\Config::getDefaults
    * @covers                   \MercadoPago\Config\Json::getSupportedExtensions
    * @covers                   \MercadoPago\Config\Yaml::getSupportedExtensions
    * @covers                   \MercadoPago\Config\Json::parse
    * @covers                   \MercadoPago\Config::_getParser
    * @expectedException        \Exception
    * @expectedExceptionMessage Unsupported configuration format
    */
    public function testNotSupportedExtension()
    {
        Config::load(dirname(__FILE__) . '/config_files/settings.ini');
    }

    /**
     * @covers                   \MercadoPago\Config::__construct
     * @covers                   \MercadoPago\Config\AbstractConfig::__construct
     * @covers                   \MercadoPago\Config\AbstractConfig::get
     * @covers                   \MercadoPago\Config\AbstractConfig::has
     * @covers                   \MercadoPago\Config\AbstractConfig::set
     * @covers                   \MercadoPago\Config::getToken
     * @covers                   \MercadoPago\Config::set
     * @covers                   \MercadoPago\Config::getDefaults
     * @covers                   \MercadoPago\RestClient::__construct
     * @covers                   \MercadoPago\RestClient::setHttpRequest
     * @covers                   \MercadoPago\RestClient::getHttpRequest
     * @covers                   \MercadoPago\RestClient::exec
     * @covers                   \MercadoPago\RestClient::post
     * @covers                   \MercadoPago\RestClient::setData
     * @covers                   \MercadoPago\RestClient::setHttpParam
     * @covers                   \MercadoPago\RestClient::getArrayValue
     * @covers                   \MercadoPago\RestClient::setHeaders
     * @covers                   \MercadoPago\Http\CurlRequest::__construct
     */
    public function testDoGetToken()
    {
        $restClient = new RestClient();
        $restClient->setHttpRequest($this->_getMockedRequest());
        
        $config = new Config(null, $restClient);
        
        $config->set('CLIENT_ID', '446950613712741');
        $config->set('CLIENT_SECRET', '0WX05P8jtYqCtiQs6TH1d9SyOJ04nhEv');
        
        $this->assertEquals('APP_USR-6295877106812064-042916-5ab7e29152843f61b4c218a551227728__LC_LB__-202809963', $config->get('ACCESS_TOKEN'));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function _getMockedRequest() {
        $hub = new FakeApiHub();
        $request = $this->getMockBuilder('MercadoPago\Http\CurlRequest')->getMock();
        $request->expects($this->once())
            ->method('execute')
            ->will($this->returnValue($hub->getJson('GET', '/oauth/token')));
        $request->expects($this->once())
            ->method('getInfo')->withAnyParameters()
            ->will($this->returnValue('200'));
        
        return $request;
    }
}