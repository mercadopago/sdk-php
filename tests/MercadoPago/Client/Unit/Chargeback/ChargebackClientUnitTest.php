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
        $result = $client->get("CB-001-2022");

        $this->assertSame(200, $result->getResponse()->getStatusCode());
        $this->assertSame("CB-001-2022", $result->id);
        $this->assertSame(19951521071, $result->payment_id);
        $this->assertSame("in_review", $result->status);
        $this->assertSame(100.0, $result->amount);
        $this->assertSame("BRL", $result->currency_id);
        $this->assertSame("Cardholder dispute", $result->reason);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Chargeback/chargeback_list.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new ChargebackClient();
        $search_request = new MPSearchRequest(20, 0, ["payment_id" => 19951521071]);
        $result = $client->search($search_request);

        $this->assertSame(200, $result->getResponse()->getStatusCode());
        $this->assertSame(1, $result->paging->total);
        $this->assertSame(1, count($result->results));
        $this->assertSame("CB-001-2022", $result->results[0]->id);
        $this->assertSame("in_review", $result->results[0]->status);
    }
}
