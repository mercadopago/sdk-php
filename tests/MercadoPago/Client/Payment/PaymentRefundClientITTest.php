<?php

namespace MercadoPago\Client\Payment;

use MercadoPago\Core\MPRequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\CardToken\CardTokenClient;
use PHPUnit\Framework\TestCase;

/**
 * PaymentRefundClient integration tests.
 */
final class PaymentRefundClientITTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        MercadoPagoConfig::setAccessToken(getenv("ACCESS_TOKEN"));
    }

    public function testRefundPartialSuccess(): void
    {
        $client = new CardTokenClient();
        $card_token = $client->create($this->createCardTokenRequest());
        $this->assertNotNull($card_token->id);

        $payment_client = new PaymentClient();
        $payment = $payment_client->create($this->createPaymentRequest($card_token->id));
        $this->assertNotNull($payment->id);

        $refund_client = new PaymentRefundClient();
        $refund = $refund_client->refund($payment->id, 50);
        $this->assertNotNull($refund->id);
        $this->assertEquals(50, $refund->amount);
        $this->assertEquals("approved", $refund->status);
    }

    public function testRefundPartialWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);

        $client = new CardTokenClient();
        $card_token = $client->create($this->createCardTokenRequest());
        $this->assertNotNull($card_token->id);

        $payment_client = new PaymentClient();
        $payment = $payment_client->create($this->createPaymentRequest($card_token->id));
        $this->assertNotNull($payment->id);

        $request_options = new MPRequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $refund_client = new PaymentRefundClient();
        $refund_client->refund($payment->id, 50, $request_options);
    }

    public function testRefundTotalSuccess(): void
    {
        $client = new CardTokenClient();
        $card_token = $client->create($this->createCardTokenRequest());
        $this->assertNotNull($card_token->id);

        $payment_client = new PaymentClient();
        $payment = $payment_client->create($this->createPaymentRequest($card_token->id));
        $this->assertNotNull($payment->id);

        $refund_client = new PaymentRefundClient();
        $refund = $refund_client->refundTotal($payment->id);
        $this->assertNotNull($refund->id);
        $this->assertEquals(100, $refund->amount);
        $this->assertEquals("approved", $refund->status);
    }

    public function testRefundTotalWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);

        $client = new CardTokenClient();
        $card_token = $client->create($this->createCardTokenRequest());
        $this->assertNotNull($card_token->id);

        $payment_client = new PaymentClient();
        $payment = $payment_client->create($this->createPaymentRequest($card_token->id));
        $this->assertNotNull($payment->id);

        $request_options = new MPRequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $refund_client = new PaymentRefundClient();
        $refund_client->refundTotal($payment->id, $request_options);
    }

    public function testGetRefundSuccess(): void
    {
        $client = new CardTokenClient();
        $card_token = $client->create($this->createCardTokenRequest());
        $this->assertNotNull($card_token->id);

        $payment_client = new PaymentClient();
        $payment = $payment_client->create($this->createPaymentRequest($card_token->id));
        $this->assertNotNull($payment->id);

        $refund_client = new PaymentRefundClient();
        $refund = $refund_client->refundTotal($payment->id);
        $this->assertNotNull($refund->id);

        $get_refund = $refund_client->get($payment->id, $refund->id);
        $this->assertEquals(100, $get_refund->amount);
        $this->assertEquals("approved", $get_refund->status);
    }

    public function testGetRefundWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);

        $client = new CardTokenClient();
        $card_token = $client->create($this->createCardTokenRequest());
        $this->assertNotNull($card_token->id);

        $payment_client = new PaymentClient();
        $payment = $payment_client->create($this->createPaymentRequest($card_token->id));
        $this->assertNotNull($payment->id);

        $refund_client = new PaymentRefundClient();
        $refund = $refund_client->refundTotal($payment->id);
        $this->assertNotNull($refund->id);

        $request_options = new MPRequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $refund_client->get($payment->id, $refund->id, $request_options);
    }

    public function testListRefundSuccess(): void
    {
        $client = new CardTokenClient();
        $card_token = $client->create($this->createCardTokenRequest());
        $this->assertNotNull($card_token->id);

        $payment_client = new PaymentClient();
        $payment = $payment_client->create($this->createPaymentRequest($card_token->id));
        $this->assertNotNull($payment->id);

        $refund_client = new PaymentRefundClient();
        $refund_one = $refund_client->refund($payment->id, 20);
        $this->assertNotNull($refund_one->id);

        $refund_two = $refund_client->refund($payment->id, 30);
        $this->assertNotNull($refund_two->id);

        $list_refund = $refund_client->list($payment->id);
        $this->assertEquals(2, count($list_refund->data));

        $this->assertEquals(20, $list_refund->data[0]["amount"]);
        $this->assertEquals("approved", $list_refund->data[0]["status"]);

        $this->assertEquals(30, $list_refund->data[1]["amount"]);
        $this->assertEquals("approved", $list_refund->data[1]["status"]);
    }

    public function testListRefundWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);

        $client = new CardTokenClient();
        $card_token = $client->create($this->createCardTokenRequest());
        $this->assertNotNull($card_token->id);

        $payment_client = new PaymentClient();
        $payment = $payment_client->create($this->createPaymentRequest($card_token->id));
        $this->assertNotNull($payment->id);

        $refund_client = new PaymentRefundClient();
        $refund_one = $refund_client->refund($payment->id, 20);
        $this->assertNotNull($refund_one->id);

        $request_options = new MPRequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $refund_client->list($payment->id, $request_options);
    }

    private function createPaymentRequest(string $token): array
    {
        $request = [
            "transaction_amount" => 100,
            "installments" => 1,
            "capture" => true,
            "description" => "Test",
            "payment_method_id" => "master",
            "token" => $token,
            "payer" => [
              "email" => "test_user_24634097@testuser.com",
            ]
        ];
        return $request;
    }

    private function createCardTokenRequest(): array
    {
        $request = [
            "card_number" => "5031433215406351",
            "expiration_year" => "2025",
            "expiration_month" => "12",
            "security_code" => "123",
            "cardholder" => [
              "name" => "APRO",
              "identification" => [
                "type" => "CPF",
                "number" => "19119119100",
              ],
            ]
        ];
        return $request;
    }
}
