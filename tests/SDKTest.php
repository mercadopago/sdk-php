<?php



use PHPUnit\Framework\TestCase;

/**
 * EntityTest Class Doc Comment
 *
 * @package MercadoPago
 */
class ConfigTest extends TestCase                                                                                       
{

    public static function setUpBeforeClass()
    {
        if (file_exists(__DIR__ . '/../.env')) {
            $dotenv = new Dotenv\Dotenv(__DIR__, '/../.env');
            $dotenv->load();
        }

        $sdk = new MercadoPago\SDK();

        //print_r(get_class(MercadoPago\SDK));

        MercadoPago\SDK::setClientId($_ENV['CLIENT_ID']);
        MercadoPago\SDK::setClientSecret($_ENV['CLIENT_SECRET']); 
    }

    /**
     * @covers                   MercadoPago\SDK
     */
    public function testSettings()
    {
        $this->assertEquals($_ENV['CLIENT_ID'], MercadoPago\SDK::getClientId());
        $this->assertEquals($_ENV['CLIENT_SECRET'], MercadoPago\SDK::getClientSecret());

    }
 
    /**
     * @covers                   MercadoPago\SDK
     */
    public function testDoGetToken()
    { 
        $this->assertNotNull(MercadoPago\SDK::getAccessToken());
    }

}
