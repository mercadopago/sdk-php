<?php 

 

/**
 * EntityTest Class Doc Comment
 *
 * @package MercadoPago
 */
class PaymentTest extends \PHPUnit\Framework\TestCase
{

    private static $last_payment;


    public static function setUpBeforeClass()
    {
        if (file_exists(__DIR__ . '/../../.env')) {
            $dotenv = new Dotenv\Dotenv(__DIR__, '../../.env');
            $dotenv->load();
        }
        
        MercadoPago\SDK::setAccessToken($_ENV['ACCESS_TOKEN']);
    }

    public function testCreatePrefence()
    {
    
         
        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = 141;
        $payment->token = $this->SingleUseCardToken('approved');
        $payment->description = "Ergonomic Silk Shirt";
        $payment->installments = 1;
        $payment->payment_method_id = "visa";
        $payment->payer = array(
            "email" => "larue.nienow@hotmail.com"
        );
        $payment->external_reference = uniqid(); 

        $payment->save(); 

        self::$last_payment = $payment;
        
 

        $this->assertEquals($payment->status, 'approved'); 

    }

    public function testFindPaymentById() { 
 

        $payment = MercadoPago\Payment::find_by_id(self::$last_payment->id); 

        $this->assertEquals($payment->id, self::$last_payment->id);
    }

    public function testPaymentsSearch() {
 
        $filters = array(
            "external_reference" => self::$last_payment->$external_reference
        );

        $payments = MercadoPago\Payment::search($filters); 

        $payment = end($payments);

        $this->assertTrue(count($payments) > 0);
        $this->assertEquals($payment->external_reference, self::$last_payment->external_reference);

    }


    private function SingleUseCardToken($status){

        $cards_name_for_status = array(
            "approved" => "APRO",
            "pending" => "CONT",
            "call_for_auth" => "CALL",
            "not_founds" => "FUND",
            "expirated" => "EXPI",
            "form_error" => "FORM",
            "general_error" => "OTHE",
        );

        $i_current_month = intval(date('m'));
        $i_current_year = intval(date('Y'));
        
        $security_code = rand(111, 999);
        $expiration_month = rand($i_current_month, 12);
        $expiration_year = rand($i_current_year + 2, 2999);
        $dni = rand(11111111, 99999999);

        $payload = array(
            "json_data" => array(
                "card_number" => "4509953566233704",
                "security_code" => (string)$security_code,
                "expiration_month" => str_pad($expiration_month, 2, '0', STR_PAD_LEFT),
                "expiration_year" => str_pad($expiration_year, 4, '0', STR_PAD_LEFT),
                "cardholder" => array(
                    "name" => $cards_name_for_status[$status],
                    "identification" => array(
                        "type" => "DNI",
                        "number" => (string)$dni
                    )
                )
            )
        );
    
        $response = MercadoPago\SDK::post('/v1/card_tokens', $payload);

        return $response['body']['id'];

    }


}

?>