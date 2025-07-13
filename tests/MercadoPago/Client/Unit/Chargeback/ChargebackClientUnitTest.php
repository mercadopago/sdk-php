<?php

namespace MercadoPago\Tests\Client\Unit\Chargeback;

use MercadoPago\Client\Chargeback\ChargebackClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * ChargebackClient unit tests.
 */
final class ChargebackClientUnitTest extends BaseClient
{
    public function testGetSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Chargeback/chargeback_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new ChargebackClient();
        $chargeback = $client->get("123456");
        
        $this->assertSame(200, $chargeback->getResponse()->getStatusCode());
        $this->assertSame("123456", $chargeback->id);
        $this->assertSame(987654321, $chargeback->payment_id);
        $this->assertSame(100.0, $chargeback->amount);
        $this->assertSame("BRL", $chargeback->currency);
        $this->assertSame("fraud", $chargeback->reason);
        $this->assertSame("chargeback", $chargeback->stage);
        $this->assertSame("open", $chargeback->status);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Chargeback/chargeback_search.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new ChargebackClient();
        $filters = array("payment_id" => "987654321");
        $search_request = new MPSearchRequest(50, 0, $filters);
        $search_result = $client->search($search_request);
        
        $this->assertSame(200, $search_result->getResponse()->getStatusCode());
        $this->assertSame(1, $search_result->paging->total);
        $this->assertSame(1, count($search_result->results));
        $this->assertSame("123456", $search_result->results[0]->id);
        $this->assertSame(987654321, $search_result->results[0]->payment_id);
    }
} 