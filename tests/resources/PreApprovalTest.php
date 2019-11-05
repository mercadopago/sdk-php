<?php 

 

/**
 * EntityTest Class Doc Comment
 *
 * @package MercadoPago
 */
class PreApprovalTest extends \PHPUnit\Framework\TestCase
{

    private static $last_preapproval;

    public static function setUpBeforeClass()
    {   
        MercadoPago\SDK::cleanCredentials();
        
        if (file_exists(__DIR__ . '/../../.env')) {
            $dotenv = new Dotenv\Dotenv(__DIR__, '../../.env');
            $dotenv->load();
        }

        MercadoPago\SDK::setClientId(getenv('CLIENT_ID'));
        MercadoPago\SDK::setClientSecret(getenv('CLIENT_SECRET')); 
    }

    public function testCreatePrefence()
    {
        $preapproval_data = new MercadoPago\Preapproval();
        $preapproval_data->payer_email = "dummy@mail.com";
        $preapproval_data->back_url = "https://google.com";
        $preapproval_data->reason = "Reason PreApproval";
        $preapproval_data->external_reference =  "VIP-0000";
        $preapproval_data->auto_recurring = array( 
                "frequency" => 1, 
                "frequency_type" => "months",
                "transaction_amount" => 60,
                "currency_id" => "ARS"
        );

        $preapproval_data->save();

        $this->assertTrue($preapproval_data->sandbox_init_point != null);

    }

}

?>