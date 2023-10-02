<?php

namespace MercadoPago\Tests\Client\Unit\PaymentMethod;

use MercadoPago\Client\PaymentMethod\PaymentMethodClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * PaymentMethodClient unit tests.
 */
final class PaymentMethodClientUnitTest extends BaseClient
{
    public function testGetSuccess(): void
    {
        $file_path = '../../../../Resources/Mocks/Response/PaymentMethod/payment_method_get.json';
        $mock_http_request = $this->mockHttpRequest($file_path, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PaymentMethodClient();
        $payment_method_result = $client->list();
        $this->assertNotNull($payment_method_result->data);
        $this->assertSame(200, $payment_method_result->getResponse()->getStatusCode());
        $this->assertCount(2, $payment_method_result->getResponse()->getContent());
        $this->assertCount(2, $payment_method_result->data);
        $this->assertCount(1, $payment_method_result->data[0]->settings);
        $this->assertCount(1, $payment_method_result->data[1]->settings);
        $this->assertCount(0, $payment_method_result->data[0]->financial_institutions);
        $this->assertCount(0, $payment_method_result->data[1]->financial_institutions);
    }
}
