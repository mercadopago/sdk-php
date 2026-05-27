<?php

namespace MercadoPago\Tests\Client\Unit\AdvancedPayment;

use MercadoPago\Client\AdvancedPayment\AdvancedPaymentClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * AdvancedPaymentClient unit tests.
 */
final class AdvancedPaymentClientUnitTest extends BaseClient
{
    public function testCreateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/AdvancedPayment/advanced_payment_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new AdvancedPaymentClient();
        $request = [
            "application_id" => "59441713004005",
            "payments" => [],
            "disbursements" => [["collector_id" => 488656838, "amount" => 80.00]],
            "payer" => ["email" => "test@test.com"],
            "external_reference" => "ADV-REF-001",
            "description" => "Marketplace split payment",
            "capture" => true
        ];
        $result = $client->create($request);

        $this->assertSame(201, $result->getResponse()->getStatusCode());
        $this->assertSame(20458724, $result->id);
        $this->assertSame("approved", $result->status);
        $this->assertSame("ADV-REF-001", $result->external_reference);
    }

    public function testGetSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/AdvancedPayment/advanced_payment_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new AdvancedPaymentClient();
        $result = $client->get(20458724);

        $this->assertSame(200, $result->getResponse()->getStatusCode());
        $this->assertSame(20458724, $result->id);
        $this->assertSame("approved", $result->status);
        $this->assertSame(true, $result->capture);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/AdvancedPayment/advanced_payment_list.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new AdvancedPaymentClient();
        $search_request = new MPSearchRequest(20, 0, ["status" => "approved"]);
        $result = $client->search($search_request);

        $this->assertSame(200, $result->getResponse()->getStatusCode());
        $this->assertSame(1, $result->paging->total);
        $this->assertSame(1, count($result->results));
        $this->assertSame(20458724, $result->results[0]->id);
    }
}
