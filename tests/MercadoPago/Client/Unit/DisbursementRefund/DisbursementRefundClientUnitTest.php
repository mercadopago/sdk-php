<?php

namespace MercadoPago\Tests\Client\Unit\DisbursementRefund;

use MercadoPago\Client\DisbursementRefund\DisbursementRefundClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * DisbursementRefundClient unit tests.
 */
final class DisbursementRefundClientUnitTest extends BaseClient
{
    public function testCreateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/DisbursementRefund/disbursement_refund_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new DisbursementRefundClient();
        $result = $client->create(20458724, 123456, 50.00);

        $this->assertSame(201, $result->getResponse()->getStatusCode());
        $this->assertSame(78901234, $result->id);
        $this->assertSame(20458724, $result->advanced_payment_id);
        $this->assertSame(123456, $result->disbursement_id);
        $this->assertSame(50.0, $result->amount);
        $this->assertSame("approved", $result->status);
    }

    public function testCreateAllSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/DisbursementRefund/disbursement_refund_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new DisbursementRefundClient();
        $result = $client->createAll(20458724, ["amount" => 50.00]);

        $this->assertSame(201, $result->getResponse()->getStatusCode());
        $this->assertSame(78901234, $result->id);
        $this->assertSame("approved", $result->status);
    }
}
