<?php

namespace MercadoPago\Client\Payment;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Client\Base\BaseClient;

/**
 * Payment Refund Client unit tests.
 */
final class PaymentRefundClientUnitTest extends BaseClient
{
    public function testCreateRefundSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Payment/payment_refund.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PaymentRefundClient();
        $payment_id = 18552260055;
        $amount = 10;

        $refund_result = $client->refund($payment_id, $amount);
        $this->assertEquals(200, $refund_result->getResponse()->getStatusCode());
        $this->assertEquals($payment_id, $refund_result->payment_id);
        $this->assertEquals($amount, $refund_result->amount);
        $this->assertEquals("2023-08-24T15:35:15.783-04:00", $refund_result->date_created);
        $this->assertEquals("approved", $refund_result->status);
        $this->assertEquals("Firstname Lastname", $refund_result->source->name);
    }

    public function testCreateRefundTotalSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Payment/payment_refund.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PaymentRefundClient();
        $payment_id = 18552260055;

        $refund_result = $client->refundTotal($payment_id);
        $this->assertEquals(200, $refund_result->getResponse()->getStatusCode());
        $this->assertEquals($payment_id, $refund_result->payment_id);
        $this->assertEquals(10, $refund_result->amount);
        $this->assertEquals("2023-08-24T15:35:15.783-04:00", $refund_result->date_created);
        $this->assertEquals("approved", $refund_result->status);
        $this->assertEquals("Firstname Lastname", $refund_result->source->name);
    }

    public function testGetRefundSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Payment/payment_refund.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PaymentRefundClient();
        $payment_id = 18552260055;
        $refund_id = 1009042015;

        $refund_result = $client->get($payment_id, $refund_id);
        $this->assertEquals(200, $refund_result->getResponse()->getStatusCode());
        $this->assertEquals($payment_id, $refund_result->payment_id);
        $this->assertEquals(10, $refund_result->amount);
        $this->assertEquals("2023-08-24T15:35:15.783-04:00", $refund_result->date_created);
        $this->assertEquals("approved", $refund_result->status);
        $this->assertEquals("Firstname Lastname", $refund_result->source->name);
    }

    public function testListRefundSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Payment/payment_refund_list.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PaymentRefundClient();
        $payment_id = 18552260055;

        $refund_result = $client->list($payment_id);
        $this->assertEquals(200, $refund_result->getResponse()->getStatusCode());
        $this->assertEquals(2, count($refund_result->data));

        $this->assertEquals($payment_id, $refund_result->data[0]["payment_id"]);
        $this->assertEquals(1009042015, $refund_result->data[0]["id"]);
        $this->assertEquals(5, $refund_result->data[0]["amount"]);
        $this->assertEquals("2023-08-24T15:35:15.783-04:00", $refund_result->data[0]["date_created"]);
        $this->assertEquals("approved", $refund_result->data[0]["status"]);
        $this->assertEquals("Test Test", $refund_result->data[0]["source"]["name"]);

        $this->assertEquals($payment_id, $refund_result->data[1]["payment_id"]);
        $this->assertEquals(1009042016, $refund_result->data[1]["id"]);
        $this->assertEquals(5, $refund_result->data[1]["amount"]);
        $this->assertEquals("2023-08-24T15:35:15.783-04:00", $refund_result->data[1]["date_created"]);
        $this->assertEquals("approved", $refund_result->data[1]["status"]);
        $this->assertEquals("Test Test", $refund_result->data[1]["source"]["name"]);
    }
}
